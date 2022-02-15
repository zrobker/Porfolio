import csv

def main():
    filename= "debt_snowball.csv"
    months = 0
    print()
    print("Welcome to the Debt Snowball Calculator")
    print()
    cash_flow = int(input ("Enter the additonal amount you want to pay \nafter all minimum payments are made: "))
    print()
    debt_dict= read_file(filename)
    total_debt = find_total_debt(debt_dict)
    while total_debt > 0:
        calculate_interest(debt_dict)
        extra = pay_min(debt_dict)
        smallest_debt= find_smallest(debt_dict)
        add_to_cash_flow =pay_smallest(debt_dict, smallest_debt, cash_flow, extra)
        cash_flow = cash_flow + add_to_cash_flow
        total_debt = find_total_debt(debt_dict)
        months += 1
    print (f"You can pay off your debt in {months} months.")
    pass

def read_file(filename):
    debt_dict = {}
    name_debt_index= 0
    amount_debt_index= 1
    interest_percent_index= 2
    min_payment_index= 3

    with open(filename, "rt") as debt_file:
        reader = csv.reader(debt_file)
        next(reader)

        for row in reader:
            name_debt= row[name_debt_index]
            amount_debt= float(row[amount_debt_index])
            interest_percent= float(row[interest_percent_index])
            min_payment= float(row[min_payment_index])

            debt_dict[name_debt] = [amount_debt,interest_percent,min_payment]

    return (debt_dict)

def calculate_interest(debt_dict):
    amount_debt_index = 0
    interest_percent_index = 1

    for key,value in debt_dict.items():
        debt_amount = value[amount_debt_index]
        yearly_interest_rate = value[interest_percent_index]
        monthly_interest = ((yearly_interest_rate /100) * debt_amount)/12
        new_amount =monthly_interest + debt_amount 
        value[amount_debt_index] = new_amount
    return monthly_interest

def pay_min(debt_dict):
    amount_debt_index = 0
    min_payment_index= 2
    extra =0
    for key,value in debt_dict.items():
        debt_amount = value[amount_debt_index]
        min_payment = value[min_payment_index]

        if min_payment > debt_amount:
            left_over = min_payment - debt_amount
            extra += left_over
            value[amount_debt_index] = 0
        else:
            new_amount = debt_amount - min_payment
            value[amount_debt_index] = new_amount
    return extra
   
def find_smallest(debt_dict):
    smallest = 999999999999
    amount_debt_index= 0
    interest_percent_index= 1
    min_payment_index= 2
    
    for key,value in debt_dict.items():
        debt_amount = value[amount_debt_index]
        if debt_amount <= smallest:
            smallest = debt_amount
            smallest_key = key
    return smallest_key

def pay_smallest(debt_dict, smallest_debt,cash_flow, extra):
    amount_debt_index = 0
    min_payment_index= 2
    add_later = 0

    value = debt_dict[smallest_debt]
    debt_amount = value[amount_debt_index]
    min_payment = value[min_payment_index]
    payment_amount = cash_flow + extra
    if payment_amount > debt_amount:
        extra = payment_amount - debt_amount
        value[amount_debt_index] = 0
        while extra > 0 and len(debt_dict)>1:
            add_later += min_payment
            debt_dict.pop(smallest_debt)
            smallest_debt = find_smallest(debt_dict)
            value = debt_dict[smallest_debt]
            min_payment = value[min_payment_index]
            debt_amount = value[amount_debt_index]
            if extra > debt_amount:
                extra -= debt_amount
                value[amount_debt_index] = 0
            else:
                value[amount_debt_index] = debt_amount - extra
                extra = 0
    else:
        new_debt_amount = debt_amount - payment_amount
        value[amount_debt_index] = new_debt_amount
        add_later= 0
    return add_later


def find_total_debt(debt_dict):
    total = 0
    amount_debt_index = 0
    for key,value in debt_dict.items():
        debt_amount = value[amount_debt_index]
        total += debt_amount
    return total

if __name__ == "__main__":
    main()
