import uuid
from models import User, Account, Transaction

# In-memory data storage
users_db = {}  # Stores User objects, keyed by user_id
accounts_db = {}  # Stores Account objects, keyed by account_id
transactions_log = [] # Stores Transaction objects

def create_user(name: str) -> User:
    """
    Creates a new user and an associated account.
    """
    user_id = uuid.uuid4().hex
    while user_id in users_db: # Extremely unlikely, but ensures uniqueness
        user_id = uuid.uuid4().hex

    account_id = uuid.uuid4().hex
    while account_id in accounts_db: # Extremely unlikely, but ensures uniqueness
        account_id = uuid.uuid4().hex

    new_user = User(user_id=user_id, name=name)
    new_account = Account(account_id=account_id, user_id=user_id, balance_usd=0.0)

    users_db[user_id] = new_user
    accounts_db[account_id] = new_account

    return new_user

def get_user_balance(user_id: str) -> float | None:
    """
    Retrieves the balance of a user's account.
    Assumes one account per user for this simulation.
    """
    if user_id not in users_db:
        return None

    # Find the account associated with this user_id
    for account in accounts_db.values():
        if account.user_id == user_id:
            return account.balance_usd
    
    return None # Should not happen if create_user correctly links user and account

def get_account_by_user_id(user_id: str) -> Account | None:
    """
    Retrieves an account object by its user_id.
    """
    for account in accounts_db.values():
        if account.user_id == user_id:
            return account
    return None

def transfer_funds(sender_user_id: str, receiver_user_id: str, amount: float) -> tuple[bool, str, Transaction | None]:
    """
    Transfers funds from the sender's account to the receiver's account.
    """
    sender_account = get_account_by_user_id(sender_user_id)
    if not sender_account:
        return (False, "Sender account not found.", None)

    receiver_account = get_account_by_user_id(receiver_user_id)
    if not receiver_account:
        return (False, "Receiver account not found.", None)

    if amount <= 0:
        return (False, "Transfer amount must be positive.", None)

    if sender_account.balance_usd < amount:
        return (False, "Insufficient funds.", None)

    # Perform transfer
    sender_account.balance_usd -= amount
    receiver_account.balance_usd += amount

    # Record transaction
    transaction_id = uuid.uuid4().hex
    # Ensure transaction_id is unique (extremely unlikely to collide, but good practice)
    while any(t.transaction_id == transaction_id for t in transactions_log):
        transaction_id = uuid.uuid4().hex
        
    new_transaction = Transaction(
        transaction_id=transaction_id,
        sender_account_id=sender_account.account_id,
        receiver_account_id=receiver_account.account_id,
        amount_usd=amount,
        status="completed" 
        # timestamp will be set by default in Transaction's __init__
    )
    transactions_log.append(new_transaction)

    return (True, "Transfer successful.", new_transaction)
