import datetime

class User:
    def __init__(self, user_id: str, name: str):
        self.user_id = user_id
        self.name = name

class Account:
    def __init__(self, account_id: str, user_id: str, balance_usd: float = 0.0):
        self.account_id = account_id
        self.user_id = user_id
        self.balance_usd = balance_usd

class Transaction:
    def __init__(self, transaction_id: str, sender_account_id: str, receiver_account_id: str, amount_usd: float, status: str, timestamp: datetime.datetime = None):
        self.transaction_id = transaction_id
        self.sender_account_id = sender_account_id
        self.receiver_account_id = receiver_account_id
        self.amount_usd = amount_usd
        self.status = status
        if timestamp is None:
            self.timestamp = datetime.datetime.now()
        else:
            self.timestamp = timestamp
