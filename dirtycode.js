main();

function main() {
    const transactions = [
        {
            id: 't1',
            type: 'PAYMENT',
            status: 'OPEN',
            method: 'CREDIT_CARD',
            amount: '23.99',
        },
        {
            id: 't2',
            type: 'PAYMENT',
            status: 'OPEN',
            method: 'PAYPAL',
            amount: '100.43',
        },
        {
            id: 't3',
            type: 'REFUND',
            status: 'OPEN',
            method: 'CREDIT_CARD',
            amount: '10.99',
        },
        {
            id: 't4',
            type: 'PAYMENT',
            status: 'CLOSED',
            method: 'PLAN',
            amount: '15.99',
        },
    ];

    try {
    processTransactions(transactions);
    } catch (error) {
        showErrorMessage(error.message)
    }
}

function processTransactions(transactions) {
    if (isEmpty(transactions)) {
        throw new Error ('No transactions provided!');
    }

    for (const transaction of transactions) {
        processTransaction(transaction);
    }
}

function processTransaction(transaction) {
    if (transaction.status !== 'OPEN') {
        throw new Error ('Transaction closed !');
    }

    if (isTransactionByCard(transaction)) {
        processCardTransaction(transaction);
    } else if (isTransactionByPayPal(transaction)) {
        processPayPalTransaction(transaction);
    } else if (isTransactionByPlan(transaction)) {
        processPlanTransaction(transaction);
    } else {
        throw new Error ('Invalid transaction method! ' + transaction.method);
    }

}

function processCardTransaction(transaction) {
    if (isPayment(transaction)) {
        processCreditCardPayment(transaction);
    } else if (isRefund(transaction)) {
        processCreditCardRefund(transaction)
    } else {
        throw new Error ('Invalid transaction type! ' + transaction.type);
    }
}

function processPayPalTransaction(transaction) {
    if (isPayment(transaction)) {
        processPayPalPayment(transaction);
    } else if (isRefund(transaction)) {
        processPayPalRefund(transaction)
    } else {
        showErrorMessage('Invalid transaction type! ' + transaction.type);
    }
}

function processPlanTransaction(transaction) {
    if (isPayment(transaction)) {
        processPlanPayment(transaction);
    } else if (isRefund(transaction)) {
        processPlanRefund(transaction)
    } else {
        showErrorMessage('Invalid transaction type! ' + transaction.type);
    }
}

function isPayment(transaction) {
    transaction.type === 'PAYMENT'
}

function isRefund(transaction) {
    transaction.type === 'REFUND'
}

function isTransactionByCard(transaction) {
    transaction.method === 'CREDIT_CARD'
}
function isTransactionByPayPal(transaction) {
    transaction.method === 'PAYPAL'
}
function isTransactionByPlan(transaction) {
    transaction.method === 'PLAN'
}


function isEmpty(transactions) {
    return !transactions || !transactions.length > 0
}

function showErrorMessage(message) {
    console.log(message);
}

function processCreditCardPayment(transaction) {
    console.log(
        'Processing credit card payment for amount: ' + transaction.amount
    );
}

function processCreditCardRefund(transaction) {
    console.log(
        'Processing credit card refund for amount: ' + transaction.amount
    );
}

function processPayPalPayment(transaction) {
    console.log('Processing PayPal payment for amount: ' + transaction.amount);
}

function processPayPalRefund(transaction) {
    console.log('Processing PayPal refund for amount: ' + transaction.amount);
}

function processPlanPayment(transaction) {
    console.log('Processing plan payment for amount: ' + transaction.amount);
}

function processPlanRefund(transaction) {
    console.log('Processing plan refund for amount: ' + transaction.amount);
}