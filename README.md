# CodeIgniter Uglify Library
A codeigniter library to minify JS and CSS files

## The problem
I've used CodeIgniter as my go-to framework for all my projects that needs to be hosted on a shared hosting. Although I'm very satisfied with what I have as a minification libraries in  other frameworks, when it comes to codeigniter, I didn't find anything that readily fits right in to my needs.

## The solution

The major credit of this goes to Matthias Mullie; for writing such an awesome minification class. I knew that this is what I needed the second I looked into his repository. So what I actually did is nothing more than a wrapper function for easier implementation with CodeIgniter.

## Installation

To install this class, simply upload the `src` folder contents to `application/libraries`. Then instantiate the class using CodeIgniter's libarary loader: `$this->load->library("ugly/ugly");`.

## Usage Examples:

```PHP

// minifying single string of code
// or single file
$result = $this->ugly->css("code goes here");
$result = $this->ugly->js("code goes here")
$result = $this->ugly->js("path/to/file")

// minifying multiple strings or files
$this->ugly->group_start("js");
// or $this->ugly->group_start("js");
$this->ugly->group_add("path/to/file");
$this->ugly->group_add("some code as string");
$result = $this->ugly->group_end();

```


## Known limitations
Check issues

## TODOs
* Update the minifier class to last version as soon as it's released

## Credits
* Major credits to Matthias Mullie for writing [minify](https://github.com/matthiasmullie/minify).

## License: The MIT License (MIT)

Copyright (c) 2016 Alex Corvi

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
