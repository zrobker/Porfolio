import math
from datetime import datetime

width = float(input("Enter the width of the tire in mm (ex 205): "))
aspect = float(input("Enter the aspect ratio of the tire (ex 60): "))
diameter = float(input("Enter the diameter of the wheel in inches (ex 15): "))

top_out = math.pi*(width**2)*aspect
top_in = width*aspect+2540*diameter
volume= top_in *top_out / 10000000

current_date = datetime.now()
with open("volumes.txt", "at") as volumes_file:
    print (current_date, f", {round(width)}, {round(aspect)}, {round(diameter)}, {volume:.1f}", file= volumes_file)

print(f"The approximate volume is {volume:.1f} milliliters")
decision = input("Would you like to buy tires with the dimensions that you have entered? (Yes/No) ")
if decision.lower() == "yes":
    user_name = input("Please enter your name: ")
    phone_num = input("Please enter your phone number: ")
    with open("volumes.txt", "at") as volumes_file:
        print ("    ", user_name, phone_num,file= volumes_file)
    print(f"Thank you {user_name}, we will call you in the next 2-4 business days!")
else:
    print("Thank you, good bye!")