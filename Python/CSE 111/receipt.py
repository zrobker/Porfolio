import csv
from datetime import datetime

def main():
    try:
        current_date_and_time = datetime.now()
        products = read_products("products.csv")
        print("GIANT EAGLE")
        print()
        num_and_price = process_requests("request.csv", products)
        print()
        print(f"Number of Items: {num_and_price[0]}")
        print(f"Subtotal: {num_and_price[1]}")
        sales_tax = .06
        sales_tax = round(num_and_price[1]*sales_tax,2)
        print(f"Sales Tax: {sales_tax}")
        total= sales_tax+num_and_price[1]
        print(f"Total: {total}")
        print()
        print("Thank you, come again!")
        print(f"{current_date_and_time:%a %b %d %I:%M.%S %Y}")

    except FileNotFoundError as file_not_found_err:
        print(f"Error: cannot open file"
                "because it doesn't exist.")
    except PermissionError as perm_err:
        print(f"Error: cannot read from file"
                "because you don't have permission.")
    except KeyError as key_err:
        print(type(key_err).__name__, key_err)

def read_products(filename):
    prod_dict ={}
    PRODUCT_INDEX= 0
    NAME_INDEX= 1
    PRICE_INDEX=2
    with open(filename, "rt") as product_file:
        reader =csv.reader(product_file)
        next(reader)
        
        for row in reader:
            prod_num = row[PRODUCT_INDEX]
            prod_name = row[NAME_INDEX]
            prod_price = float(row[PRICE_INDEX])

            prod_dict[prod_num] = [prod_name, prod_price]
            
    return prod_dict

def process_requests(filename, products):
    with open(filename, "rt") as request_file:
        reader = csv.reader(request_file)
        next(reader)
        quantity=0
        total=0

        for row in reader:
            product = row[0]
            new_quantity = int(row[1])
            
            if product in products:
                value = products[product]
                name_of_product = value[0]
                price_of_product= float(value[1])
                print(f"{name_of_product}: {new_quantity} @ {price_of_product}")
                quantity += new_quantity
                new_total = new_quantity * price_of_product
                total += new_total
            else:
                print("User odered non-existent item.") 

    return  quantity, total



if __name__ == "__main__":
    main()