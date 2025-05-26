import unittest
from models import User, Account, Transaction
from core_logic import (
    create_user,
    get_user_balance,
    transfer_funds,
    get_account_by_user_id,
    users_db,
    accounts_db,
    transactions_log
)

class TestCoreLogic(unittest.TestCase):

    def setUp(self):
        """Clear data stores before each test for isolation."""
        users_db.clear()
        accounts_db.clear()
        transactions_log.clear()

    def test_create_user(self):
        """Test user creation and initial account setup."""
        user = create_user("Alice")
        self.assertIsInstance(user, User)
        self.assertEqual(user.name, "Alice")
        self.assertIn(user.user_id, users_db)
        
        account = get_account_by_user_id(user.user_id)
        self.assertIsNotNone(account)
        self.assertIsInstance(account, Account)
        self.assertEqual(account.user_id, user.user_id)
        self.assertEqual(account.balance_usd, 0.0)
        self.assertIn(account.account_id, accounts_db)

    def test_get_user_balance(self):
        """Test retrieving user balance."""
        user_alice = create_user("Alice")
        
        # Test balance for existing user
        balance_alice = get_user_balance(user_alice.user_id)
        self.assertEqual(balance_alice, 0.0)
        
        # Test balance for non-existent user
        balance_non_existent = get_user_balance("non_existent_user_id")
        self.assertIsNone(balance_non_existent)

        # Test after manually setting a balance (though typically done via transfers)
        account_alice = get_account_by_user_id(user_alice.user_id)
        if account_alice:
            account_alice.balance_usd = 500.75
        
        balance_alice_updated = get_user_balance(user_alice.user_id)
        self.assertEqual(balance_alice_updated, 500.75)


    def test_transfer_funds_successful(self):
        """Test a successful fund transfer."""
        user_a = create_user("UserA")
        user_b = create_user("UserB")

        account_a = get_account_by_user_id(user_a.user_id)
        self.assertIsNotNone(account_a)
        account_a.balance_usd = 100.0  # Set initial balance for sender

        success, message, transaction = transfer_funds(user_a.user_id, user_b.user_id, 30.0)

        self.assertTrue(success)
        self.assertEqual(message, "Transfer successful.")
        self.assertIsNotNone(transaction)
        self.assertIsInstance(transaction, Transaction)
        
        self.assertEqual(get_user_balance(user_a.user_id), 70.0)
        self.assertEqual(get_user_balance(user_b.user_id), 30.0)
        
        self.assertEqual(len(transactions_log), 1)
        logged_tx = transactions_log[0]
        self.assertEqual(logged_tx.sender_account_id, account_a.account_id)
        self.assertEqual(logged_tx.receiver_account_id, get_account_by_user_id(user_b.user_id).account_id)
        self.assertEqual(logged_tx.amount_usd, 30.0)
        self.assertEqual(logged_tx.status, "completed")

    def test_transfer_funds_insufficient_funds(self):
        """Test fund transfer with insufficient funds."""
        user_a = create_user("UserA")
        user_b = create_user("UserB")

        account_a = get_account_by_user_id(user_a.user_id)
        self.assertIsNotNone(account_a)
        account_a.balance_usd = 20.0  # Sender has only 20

        success, message, transaction = transfer_funds(user_a.user_id, user_b.user_id, 50.0)

        self.assertFalse(success)
        self.assertEqual(message, "Insufficient funds.")
        self.assertIsNone(transaction)
        
        self.assertEqual(get_user_balance(user_a.user_id), 20.0) # Balance unchanged
        self.assertEqual(get_user_balance(user_b.user_id), 0.0)  # Balance unchanged
        self.assertEqual(len(transactions_log), 0) # No transaction logged

    def test_transfer_funds_invalid_user(self):
        """Test fund transfer with invalid sender or receiver."""
        user_a = create_user("UserA")
        account_a = get_account_by_user_id(user_a.user_id)
        self.assertIsNotNone(account_a)
        account_a.balance_usd = 100.0

        # Test with non-existent receiver
        success, message, transaction = transfer_funds(user_a.user_id, "non_existent_receiver_id", 10.0)
        self.assertFalse(success)
        self.assertEqual(message, "Receiver account not found.")
        self.assertIsNone(transaction)
        self.assertEqual(get_user_balance(user_a.user_id), 100.0) # Balance unchanged
        self.assertEqual(len(transactions_log), 0)

        # Test with non-existent sender
        user_b = create_user("UserB") # Receiver exists
        success, message, transaction = transfer_funds("non_existent_sender_id", user_b.user_id, 10.0)
        self.assertFalse(success)
        self.assertEqual(message, "Sender account not found.")
        self.assertIsNone(transaction)
        self.assertEqual(get_user_balance(user_b.user_id), 0.0) # Balance unchanged
        self.assertEqual(len(transactions_log), 0)

    def test_transfer_funds_negative_amount(self):
        """Test fund transfer with a negative amount."""
        user_a = create_user("UserA")
        user_b = create_user("UserB")

        account_a = get_account_by_user_id(user_a.user_id)
        self.assertIsNotNone(account_a)
        account_a.balance_usd = 100.0

        success, message, transaction = transfer_funds(user_a.user_id, user_b.user_id, -10.0)

        self.assertFalse(success)
        self.assertEqual(message, "Transfer amount must be positive.")
        self.assertIsNone(transaction)
        
        self.assertEqual(get_user_balance(user_a.user_id), 100.0) # Balance unchanged
        self.assertEqual(get_user_balance(user_b.user_id), 0.0)  # Balance unchanged
        self.assertEqual(len(transactions_log), 0)

    def test_transfer_funds_zero_amount(self):
        """Test fund transfer with zero amount."""
        user_a = create_user("UserA")
        user_b = create_user("UserB")

        account_a = get_account_by_user_id(user_a.user_id)
        self.assertIsNotNone(account_a)
        account_a.balance_usd = 100.0

        success, message, transaction = transfer_funds(user_a.user_id, user_b.user_id, 0.0)

        self.assertFalse(success)
        self.assertEqual(message, "Transfer amount must be positive.") # Assuming 0 is not positive
        self.assertIsNone(transaction)
        
        self.assertEqual(get_user_balance(user_a.user_id), 100.0) 
        self.assertEqual(get_user_balance(user_b.user_id), 0.0)  
        self.assertEqual(len(transactions_log), 0)

if __name__ == "__main__":
    unittest.main()
