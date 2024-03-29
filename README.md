# PinkCrab Form Fields #

![alt text](https://img.shields.io/badge/Current_Version-0.1.8-yellow.svg?style=flat " ") 
[![Open Source Love](https://badges.frapsoft.com/os/mit/mit.svg?v=102)](https://github.com/ellerbrock/open-source-badge/)
![](https://github.com/Pink-Crab/Form-Fields/workflows/GitHub_CI/badge.svg " ")
[![codecov](https://codecov.io/gh/Pink-Crab/Form-Fields/branch/master/graph/badge.svg?token=ZE140NBNPG)](https://codecov.io/gh/Pink-Crab/Form-Fields)



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
![](/docs/assets/basic_input_with_current.png)

You can return the HTML string of the input using as\__string_\(\)

```php
Input_Text::create( 'my_input' )
    ->current( MyData::getOption( 'my_option', 'fallback' ) )
    ->as_string();
```

![](/docs/assets/simple_input_html.png)

### Field Types

* [Text](/docs/input_text.md)
* Search
* Password
* Email
* URL
* Tel
* Number
* Range
* Text Area
* Date
* Date Time
* Checkbox (Single & Group)
* Radio
* Select
* Raw HTML
* Hidden
* Week
* Month
* Image (button)
* Submit

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
**Release 0.1.7**

## Change Log
* 0.1.8 - Label is now auto shown if length is above 0 and hidden if 0.
* 0.1.7 - Added in missing URL field, also all tests cleaned up and all attributes are now just controlled by attributes, not custom properties. Added in the Datalist attribute to all valid input fields. Tests extended running over 1500 assertions
* 0.1.6 - Added in missing fields [ Colour(inc alias Color), Week, Time, Month, File, Image, Submit & Tel ] and moved to a new abstract INPUT which is used to extend all \<INPUT\> fields from a base abstract input. Tests cleaned up and all attributes are now just controlled by attributes, not custom properties.
* 0.1.5 - Allow numerical strings for select options.
* 0.1.4 - Removed default as not implemented and not really suitable for this library. Also included the option to set custom name attributes to fields, falling back to the key (id) if not set.
* 0.1.3 - Added in the Checkbox Group field
* 0.1.2 - Various bug fixes
* 0.1.1 - Various bug fixes


