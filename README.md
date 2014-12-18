# EW_EnhancedEmails

This module is intended to provide assistance with development of Magento emails. 
Currently, however, it simply adds a new email directive – dateformat.

## Installation via [modman](https://github.com/colinmollenhour/modman)

```
$ cd <magento root>
$ modman init # if you've never used modman on this Magento instance
$ modman clone https://github.com/ericthehacker/magento-enhancedemails.git
```

Be sure to flush your cache after installation!

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
{{dateformat var=<date variable> [originalFormat=<optional hint for original date format>] [format=<optional target Zend_Date format>] [include_time=<true/false>]}}
```

### Examples

- To format a date from a Mysql datetime column in the form "Year-Month-Day", the following directive may be used:
  `{{dateformat var=<date variable> format=Y-M-d}}`
- To format a date from a Mysql datetime column automatically using the email's store's locale, the following directive may be used:
  `{{dateformat var=<date variable>}}`
- To format a date from a Mysql datetime column automatically using the email's store's locale *including* time, the following directive may be used:
  `{{dateformat var=<date variable> include_time=true}}`
