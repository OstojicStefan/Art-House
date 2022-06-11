import pytest
import selenium.webdriver

@pytest.fixture
def browser():
    br = selenium.webdriver.Chrome()
    br.implicitly_wait(10)
    yield br
    br.quit()
    