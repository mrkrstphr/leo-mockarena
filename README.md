# leo-mockarena

Extends [Leo's](http://peridot-php.github.io/leo/) matcher library with helpers for evaluating 
[Mockarena](https://github.com/mrkrstphr/mockarena) mocks.

# Example

```php
it('should add a login_url filter', function () {
    $fn = $this->mocker->mock('add_filter');
    $class = new WPSingleSignOn($this->apiClient->reveal());

    expect($fn)->to->have->been->called(1);
    expect($fn)->calls(0)->to->have->arguments('login_url', [$class, 'redirectToProvider'], 10, 2);
});
```
