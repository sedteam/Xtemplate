XTemplate - PHP Templating Engine
=================================

![License: LGPL/BSD](https://img.shields.io/badge/License-LGPL%20%2F%20BSD-blue.svg) ![PHP Version](https://img.shields.io/badge/PHP-5.0%2B-brightgreen.svg)

## Table of Contents

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Basic Usage](#basic-usage)
4. [Template Syntax](#template-syntax)
5. [Blocks and Variables](#blocks-and-variables)
6. [Conditional Logic](#conditional-logic)
7. [Callback Functions](#callback-functions)
8. [Error Handling](#error-handling)
9. [Performance Optimization](#performance-optimization)
10. [Contributing](#contributing)
11. [License](#license)

Introduction
------------

**XTemplate** is a fast and lightweight PHP templating engine designed to separate PHP code logic from the presentation layer (HTML, XML, etc.). It enables developers to focus on programming while allowing designers to concentrate on design. Originally created by Barnabas Debreceni in 2000, it was enhanced by Jeremy Coates until 2007, and later improved within the Seditio fork (< 180v). The current version includes significant updates by Alexander Tishov and the Seditio Team (2025), such as conditional logic, enhanced error handling, and optimized HTML compression.

**Purpose**: Simplify the creation of dynamic web pages while maintaining clean code and high performance.

Installation
------------

1.  **Download the repository**:
    
        git clone https://github.com/sedteam/Xtemplate/xtemplate.git
    
2.  **Include in your project**: Copy `xtemplate.class.php` to your project directory and include it:
    
        <?php
        require_once 'xtemplate.class.php';
        ?>
    

For upgrades:

*   Test the new version on sample code.
*   Back up the current version.
*   Replace the old file with the new one and verify functionality.

Basic Usage
-----------

Create an `XTemplate` instance, assign variables, parse the template, and output the result:

    <?php
    require_once 'xtemplate.class.php';
    
    $xtpl = new XTemplate('templates/example.tpl');
    $xtpl->assign('TITLE', 'Hello, World!');
    $xtpl->parse('MAIN');
    $xtpl->out('MAIN');
    ?>

**templates/example.tpl**:

    <!-- BEGIN: MAIN -->
    <h1>{TITLE}</h1>
    <!-- END: MAIN -->

**Output**:

    <h1>Hello, World!</h1>

Template Syntax
---------------

### Variables

*   Simple: `{VAR}` — replaced with the value of `VAR`.
*   Arrays: `{ROW.ID}` — accesses `ROW['ID']`.
*   Globals: `{PHP._SERVER.HTTP_HOST}` — accesses PHP global variables.

### Blocks

*   Block start: `<!-- BEGIN: BLOCK_NAME -->`.
*   Block end: `<!-- END: BLOCK_NAME -->`.
*   Nested blocks: Supported for complex structures.

Blocks and Variables
--------------------

Example with nested blocks:

    $xtpl->assign('USERS', [
        ['NAME' => 'Alex', 'DETAILS' => ['AGE' => 30]],
        ['NAME' => 'Maria', 'DETAILS' => ['AGE' => 25]]
    ]);
    $xtpl->parse('MAIN');
    $xtpl->out('MAIN');

**templates/example.tpl**:

    <!-- BEGIN: MAIN -->
    <ul>
        <!-- BEGIN: user -->
        <li>{USER.NAME} ({USER.DETAILS.AGE} years)</li>
        <!-- END: user -->
    </ul>
    <!-- END: MAIN -->

**Output**:

    <ul>
        <li>Alex (30 years)</li>
        <li>Maria (25 years)</li>
    </ul>

\- **Dynamic Blocks**: Multi-level nested blocks with recursive parsing via `rparse`.  
\- **Auto-reset**: Sub-blocks reset after parsing the parent by default (disable with `clear_autoreset()`).  
\- **Null Strings**: Set defaults for unassigned variables or blocks:

    $xtpl->set_null_string('Not specified', 'VAR');

Conditional Logic
-----------------

Support for conditions with operators (`>`, `<`, `==`, `!=`, `&&`, `||`, etc.):

    $xtpl->assign('USER_AGE', 20);
    $xtpl->assign('USER_LOGGED_IN', true);
    $xtpl->parse('MAIN');
    $xtpl->out('MAIN');

**templates/example.tpl**:

    <!-- BEGIN: MAIN -->
    <!-- IF USER_AGE > 18 && USER_LOGGED_IN -->
        <p>Access granted.</p>
    <!-- ELSE -->
        <p>Access denied.</p>
    <!-- ENDIF -->
    <!-- END: MAIN -->

**Output**:

    <p>Access granted.</p>

Callback Functions
------------------

Apply PHP functions to variables within the template:

    $xtpl->assign('TEXT', 'hello, world');
    $xtpl->parse('MAIN');
    $xtpl->out('MAIN');

**templates/example.tpl**:

    <!-- BEGIN: MAIN -->
    <p>{TEXT|strtoupper}</p>
    <!-- END: MAIN -->

**Output**:

    <p>HELLO, WORLD</p>

With parameters:

    <p>{TEXT|str_replace("world","everyone")}</p>

**Output**: `<p>hello, everyone</p>`

The list of allowed functions is customizable via `$allowed_callbacks`.

Error Handling
--------------

\- **Modes**: Configurable via `error_handling` (`log`, `display`, `both`, `none`).  
\- **Logging**: Errors are written to a file specified in `error_log_file`:

    $xtpl = new XTemplate(['file' => 'example.tpl', 'error_handling' => 'both', 'error_log_file' => 'errors.log']);
    $xtpl->debug = true;

Example error output:

    <!-- XTemplate Errors for Block: MAIN -->
    <b>[XTemplate Errors]</b><ul><li>parse: blockname [unknown] does not exist (Context: File: example.tpl, Block: unknown, Time: 2025-03-04 12:00:00)</li></ul>

Performance Optimization
------------------------

\- **Speed**: The algorithm avoids recursive calls for block tree construction, making it one of the fastest templating engines with nested block support.  
\- **Compression**: Enable `compress_output` for HTML minification:

    $xtpl->compress_output = true;

\- **File Caching**: Repeated template file access is cached in `$filecache`.

Contributing
------------

We welcome contributions! To get involved:

1.  Fork the repository on [GitHub](https://github.com/sedteam/Xtemplate).
2.  Submit a pull request with your changes.
3.  Open an issue to report bugs or suggest ideas.

Additional resources:

*   [seditio.org](http://seditio.org/)
*   [SourceForge](http://sourceforge.net/projects/xtpl/)

License
-------

XTemplate is dual-licensed under **LGPL** and **BSD**. See details in [license.txt](https://github.com/sedteam/Xtemplate/blob/main/license.txt).

History
-------

XTemplate was created by Barnabas Debreceni (cranx) in 2000 as a simple and fast templating engine, inspired by the syntax of FastTemplate and QuickTemplate. The code was written from scratch in a single day without borrowing from other engines and optimized for speed with a unique block-processing algorithm.

In 2002, cranx handed the project over to Jeremy Coates (cocomp), who maintained it until 2007, releasing stable versions on SourceForge (last revision: `$Id: README.txt 16 2007-01-11 03:02:49Z cocomp $`). After a period of inactivity, the project was revived within the Seditio fork. In 2025, Alexander Tishov and the Seditio Team added modern features like RPN-based conditional logic, enhanced compression, and error handling.

Historical data:

*   SVN: `$HeadURL: https://xtpl.svn.sourceforge.net/svnroot/xtpl/trunk/README.txt $`
*   Latest versions: [SourceForge](http://sourceforge.net/projects/xtpl/)
