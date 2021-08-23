# PinkCrab Form Fields #

![alt text](https://img.shields.io/badge/Current_Version-0.5.0-yellow.svg?style=flat " ") 
[![Open Source Love](https://badges.frapsoft.com/os/mit/mit.svg?v=102)](https://github.com/ellerbrock/open-source-badge/)
![](https://github.com/Pink-Crab/Form-Fields/workflows/GitHub_CI/badge.svg " ")
[![codecov](https://codecov.io/gh/Pink-Crab/Form-Fields/branch/master/graph/badge.svg?token=R3SB4WDL8Z)](https://codecov.io/gh/Pink-Crab/Form-Fields)



A simple way of parsing html5 form elements. Not a comprensive package, just enough to render most fields in wp-admin.
### Installation

To install from composer please run

```bash
composer require pinkcrab/form_fields
```

### Basic Usage

To create a simple form field and render\(print\) it to the screen

```php
Input_Text::create( 'my_input' )
    ->current( get_option( 'my_option', 'fallback' ) )
    ->render();
```

![](/docs/assets/simple_input.png)
![](/docs/assets/basic_input_with_current.pngassets/simple_input.png)

You can return the HTML string of the input using as\__string_\(\)

```php
Input_Text::create( 'my_input' )
    ->current( get_option( 'my_option', 'fallback' ) )
    ->as_string();
```

![](/docs/assets/simple_input_html.png)

### Field Types

* [Text](https://glynn-quelch.gitbook.io/pinkcrab/modules/modules/form-fields/input_text)
* Number
* Password
* Email
* Range
* Date
* Date Time
* Checkbox
* Radio
* Select
* Raw HTML
* Hidden
* Text Area

All inputs are extended from the Abstract\_Field class and have all the functionality laid out in the Base Field section.

Labels

### Output

Each form field is preloaded with a parser which can either render the input field or return the HTML. If you create your own field, you can make use of our existing parsers or create your own, using the Parser interface.

```php
Input_Text::create('test')->render()    // Prints the input
Input_Text::create('test')->as_string() // Returns as HTML string.
```

### Field Creation

All of our Form Fields has protected `__construct`'ors and need to be created using the **create\(\)** named constructor.

```php
Input_Text::create('name')->render();
Input_Email::create('email')->render();
Input_Password::create('password')->render();
```










## Version ##
**Release 0.1.0**


