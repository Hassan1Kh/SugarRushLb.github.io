from core_logic import (
    create_user,
    get_user_balance,
    transfer_funds,
    users_db,
    accounts_db,
    transactions_log,
    get_account_by_user_id # Needed to display account ID in create_user response
)

def cli_create_user():
    """Handles the 'Create User' CLI command."""
    name = input("Enter user's name: ")
    if not name.strip():
        print("User name cannot be empty.")
        return
    
    new_user = create_user(name)
    # To show account ID, we need to fetch the associated account
    user_account = get_account_by_user_id(new_user.user_id)
    if user_account:
        print(f"User '{new_user.name}' created successfully!")
        print(f"User ID: {new_user.user_id}")
        print(f"Account ID: {user_account.account_id}")
    else:
        # This case should ideally not happen if create_user works correctly
        print(f"User '{new_user.name}' created with User ID: {new_user.user_id}, but could not retrieve account details.")


def cli_show_all_users():
    """Handles the 'Show All Users' CLI command."""
    if not users_db:
        print("No users found.")
        return
    print("\n--- All Users ---")
    for user_id, user in users_db.items():
        print(f"User ID: {user_id}, Name: {user.name}")
    print("-----------------\n")


def cli_show_user_balance():
    """Handles the 'Show User Balance' CLI command."""
    user_id = input("Enter User ID to check balance: ")
    balance = get_user_balance(user_id)
    if balance is not None:
        user_name = users_db.get(user_id).name if users_db.get(user_id) else "Unknown User"
        print(f"Balance for User {user_name} (ID: {user_id}): ${balance:.2f}")
    else:
        print(f"User ID '{user_id}' not found or no account associated.")


def cli_transfer_funds():
    """Handles the 'Transfer Funds' CLI command."""
    sender_user_id = input("Enter Sender User ID: ")
    receiver_user_id = input("Enter Receiver User ID: ")
    try:
        amount_str = input("Enter amount to transfer: ")
        amount = float(amount_str)
    except ValueError:
        print("Invalid amount. Please enter a numeric value.")
        return

    if sender_user_id == receiver_user_id:
        print("Sender and receiver cannot be the same user.")
        return

    success, message, _ = transfer_funds(sender_user_id, receiver_user_id, amount)
    
    if success:
        print(f"Success: {message}")
    else:
        print(f"Error: {message}")


def cli_view_all_transactions():
    """Handles the 'View All Transactions' CLI command."""
    if not transactions_log:
        print("No transactions found.")
        return
    print("\n--- All Transactions ---")
    for tx in transactions_log:
        print(f"ID: {tx.transaction_id}, From: {tx.sender_account_id}, To: {tx.receiver_account_id}, Amount: ${tx.amount_usd:.2f}, Status: {tx.status}, Time: {tx.timestamp}")
    print("----------------------\n")


def main():
    """Main function to run the CLI loop."""
    while True:
        print("\nBanking System CLI")
        print("1. Create User")
        print("2. Show All Users")
        print("3. Show User Balance")
        print("4. Transfer Funds")
        print("5. View All Transactions")
        print("6. Exit")
        
        choice = input("Enter your choice (1-6): ")
        
        if choice == '1':
            cli_create_user()
        elif choice == '2':
            cli_show_all_users()
        elif choice == '3':
            cli_show_user_balance()
        elif choice == '4':
            cli_transfer_funds()
        elif choice == '5':
            cli_view_all_transactions()
        elif choice == '6':
            print("Exiting CLI. Goodbye!")
            break
        else:
            print("Invalid choice. Please enter a number between 1 and 6.")

if __name__ == "__main__":
    main()
