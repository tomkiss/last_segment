# last_segment Expression Engine 1.x extension

This little extension creates a new global variable which fetches the current last segment in a URL and registers it as a global variable.

The addition of a `{last_segment}` variable can be extremely useful for a number of reasons. The main benefit is that it allows you to create the appearance of sub-templates and hierarchical page structures. For example, you could have a 'pages' weblog and by setting the url_title parameter of the weblog:entries tag to `{last_segment}`, create a structure of:
`/head/shoulders/knees/toes/`.

The extension also sets global variables for the last segment but ignoring pagination in the URL, and a variable for returning the current URL.

For more information please visit: http://www.tomkiss.net/ee/add-on/last_segment
