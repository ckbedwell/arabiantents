# Using CSS

To ease the workflow I've added webpack to handle css bundling and minification.

It uses post-css, which is essentially SASS, so you can use nicities like CSS nesting and it will automatically add prefixes and minify the code for us.

To set it up you must have node and npm installed. I have listed the versions I am using in package.json under engines.

Once you have node and npm setup, do `npm i` to install all the dependencies. Then whenever you need to create production code do `npm run build`.