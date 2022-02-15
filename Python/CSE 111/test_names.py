from names import make_full_name, \
    extract_given_name, extract_family_name
import pytest

def test_make_full_name():
  assert make_full_name("","") == "; "
  assert make_full_name('Sally', 'Brown') == 'Brown'';' 'Sally'
  assert make_full_name('Michael', 'Crain-Zamora') == 'Crain-Zamora'';' 'Michael'

def test_extract_given_name():
  assert extract_given_name(" ; ") == (" ")
  assert extract_given_name("Brown; Sally") == ("Sally")
  assert extract_given_name("Abernathy ; Madison") == ("Madison")
  assert extract_given_name("Jones; Mary-Jo") == ("Mary-Jo")
  

def test_extract_family_name():
  assert extract_family_name(" ; ") == (" ")
  assert extract_family_name("Brown; Sally") == ("Brown")
  assert extract_family_name("Buttersworth; Mrs.") == ("Buttersworth")
  assert extract_family_name("Covey;Lara-Jean") == ("Covey")


pytest.main(["-v", "--tb=line", "-rN", "test_names.py"])