# EW_EnhancedEmails

This module is intended to provide assistance with development of Magento emails. 
Currently, however, it simply adds a new email directive – dateformat.

## dateformat Email Directive

### Background

There is currently no way to format dates in Magento emails. Often, date variables are already available via objects 
passed to email templates, but the "dates" are in the format of the underlying database and are not suitable for
customer-facing correspondences. 

To format dates using the robust 
[Zend_Date formatting capabilities](http://framework.zend.com/manual/1.12/en/zend.date.constants.html#zend.date.constants.selfdefinedformats), 
this module adds the new `dateformat` directive.

### Usage 

Usage of the new directive is of the following form:

```
{{dateformat var=<date variable> [originalFormat=<optional hint for original date format>] [format=<optional target Zend_Date format>] [include_time=<true/false>]  
```

### Examples

- To format a date from a Mysql datetime column in the form "Year-Month-Day", the following directive may be used:
  `[[dateformat var=<date variable> format=Y-M-d}}`