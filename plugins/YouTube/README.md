# mdbl0g YouTube Plugin
Works for `youtube.com` and `youtu.be` as well as it supports `http://` and `https://` (But doesn't embed via `https://`).

It transforms the following links to YouTube videos into embedded videos:

    [Awesome foobar video!](http(s)://www.youtube.com/watch?v=foobar)
    [Awesome foobar video!](http(s)://youtube.com/watch?v=foobar)
    [Awesome foobar video!](http(s)://www.youtu.be/foobar)
	[Awesome foobar video!](http(s)://youtu.be/foobar)
	
But also replaces blank URLS

    http(s)://www.youtube.com/watch?v=foobar
    http(s)://youtube.com/watch?v=foobar
    http(s)://www.youtu.be/foobar
    http(s)://youtu.be/foobar