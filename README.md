FreshPHP [![Build Status](https://secure.travis-ci.org/Stichoza/FreshPHP.png?branch=master)](http://travis-ci.org/Stichoza/FreshPHP)
========

This is some sort of lightweight (or maybe overly complicated) PHP framework with underlying MVC architecture implementing some other OOP design patterns like Singleton and etc.

Currently I'm writing this for educational purposes only but I'm using this in some of my projects.

___

## Contributing to FreshPHP

### Issue Tracking

Report bugs and issues (good ideas also) in [Issue Tracker](//github.com/Stichoza/FreshPHP/issues)

 - **Search for existing issues** to avoid duplicate issues.
 - **Include a live example** if possible.
 - **Share as much information as possible.** Include operating system and version. Information about PHP, MySQL, Mail Server and any other used software used.
 - Also include steps to reproduce the bug.

### Pull Requests

All pull requests are welcome! :metal:

### Coding Standards

Inspired by [Java Code Conventions](http://www.oracle.com/technetwork/java/javase/documentation/codeconvtoc-136057.html).

 - class storing: `src/Namespace/.../Namespace/ClassName.php`
 - Braces on same line. **Never** use new lines for braces.
 - Four spaces for indentation, never tabs.
 - Use proper indentation.
 - Double quotes preferred.
 - Comma last, Dot first.
 - Each line should contain at most one statement.
 - Lower-first `camelCase` for variables and functions/methods
 - Upper-first `CamelCase` for class names


```php
// Correct
if ($foo > 15) {
    $foo++;
    $bar--;
    print("ok");
    $newArray = array(
    "key_1" => 452,
        "key_2" => array(
            "key_2_1" => "yolo"
        ),
    "key_3" => "hello",
    "key_4" => "world"
    );
    echo "hello "
        . "world "
        . $foo . ":>";
}
```
```php
if($foo>15)                         // Spaces around operators, spaces after keywords
{                                   // Don't use new lines for braces
    $foo++; $bar--;                 // Each line should contain at most one statement
    print('ok');                    // Use double quotes
    $new_array = array(             // Use camelCase in variable naming
    "key-1" => 452,                 // Never use dashes in array keys. Use underscores.
        "key_2" => array("key_2_1" => "yolo"),    // Use proper indentation.
    "key_3" => "hello"
    , "key_4" => "world"            // Comma-last
    );
    echo "hello hello " .           // Dot-first
        "world " .
        $foo.":>";                  // Use spaces around dots.
}
```
