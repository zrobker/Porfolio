from debt_snowball_calculator import calculate_interest, find_smallest, pay_smallest,pay_min, find_total_debt
from pytest import approx
import pytest

def test_calculate_interest():
    #whole number
    dictionary ={'car':[10000,6,100]}
    calculate_interest(dictionary)
    assert dictionary == {'car':[10050,6,100]}

    #decimal and multiple
    dictionary ={'credit card':[105,18.4,5],'car':[10000,6,100],'loan from dad':[1250,3,50]}
    calculate_interest(dictionary)
    assert dictionary == {'credit card':[106.61,18.4,5],'car':[10050,6,100],'loan from dad':[1253.125,3,50]}

    #zero percent interest
    dictionary ={'loan from dad':[1250,0,50]}
    interest = calculate_interest(dictionary)
    assert interest == approx(0)

    #large debt
    dictionary ={'school loan':[87498,7.3,400]}
    interest = calculate_interest(dictionary)
    assert interest == approx(532.28)

def test_find_smallest():
    #multiple different numbers
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    smallest_key = find_smallest(dictionary)
    assert smallest_key == "credit card"

    #same number = picks last
    dictionary ={'school loan':[1250,0,50],'loan from dad':[1250,0,50],'credit card':[1250,0,50]}
    smallest_key = find_smallest(dictionary)
    assert smallest_key == "credit card"

    #when only 1
    dictionary ={'credit card':[100000,18.4,5]}
    smallest_key = find_smallest(dictionary)
    assert smallest_key == "credit card"

def test_pay_smallest():
    #When cash flow and extra are zero
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    smallest_debt = "credit card"
    cash_flow = 0
    extra = 0
    add_later = pay_smallest(dictionary,smallest_debt,cash_flow,extra)
    assert dictionary=={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    assert add_later == 0

    #when smallest is payed off 
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    smallest_debt = "credit card"
    cash_flow = 500
    extra = 0
    add_later = pay_smallest(dictionary,smallest_debt,cash_flow,extra)
    assert dictionary=={'school loan':[87498,7.3,400],'loan from dad':[855,0,50],'car':[10000,6,100]}
    assert add_later == 5

    #when multiple debts are payed off
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    smallest_debt = "credit card"
    cash_flow = 1800
    extra = 200
    add_later = pay_smallest(dictionary,smallest_debt,cash_flow,extra)
    assert dictionary=={'school loan':[87498,7.3,400],'car':[9355,6,100]}
    assert add_later == 55

def test_pay_min():
    #normal
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,5],'car':[10000,6,100]}
    extra = pay_min(dictionary)
    assert dictionary == {'school loan':[87098,7.3,400],'loan from dad':[1200,0,50],'credit card':[100,18.4,5],'car':[9900,6,100]}
    assert extra ==0

    #min payment pays off loan
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,125],'car':[10000,6,100]}
    extra = pay_min(dictionary)
    assert dictionary == {'school loan':[87098,7.3,400],'loan from dad':[1200,0,50],'credit card':[0,18.4,125],'car':[9900,6,100]}
    assert extra ==20

    #min payments pay off multiple loans
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[100,0,150],'credit card':[105,18.4,125],'car':[10000,6,100]}
    extra = pay_min(dictionary)
    assert dictionary == {'school loan':[87098,7.3,400],'loan from dad':[0,0,150],'credit card':[0,18.4,125],'car':[9900,6,100]}
    assert extra ==70

def test_find_total_debt():
    #all debts paid
    dictionary ={}
    total_debt = find_total_debt(dictionary)
    assert total_debt == 0

    #one debt
    dictionary ={'school loan':[87498,7.3,400]}
    total_debt = find_total_debt(dictionary)
    assert total_debt == 87498

    #mutiple debts
    dictionary ={'school loan':[87498,7.3,400],'loan from dad':[1250,0,50],'credit card':[105,18.4,125],'car':[10000,6,100]}
    total_debt = find_total_debt(dictionary)
    assert total_debt == 98853

pytest.main(["-v", "--tb=line", "-rN", "test_debt_snowball_calculator.py"])