# I Feel PreTTY
I Feel PreTTY is a package for formatting PHP scripts on ANSI
terminals. Script output is often going by too fast to read, or has
too little information to be useful. There is often no indication of
how long until done. Adding colors and grouped indentation and an
estimated time to completion leaves you that much more prepared for
those late nights running those unnerving migrations

distributed under the MIT license.

## What you get right away
1. Automatic indent management with tier grouping
2. ANSI colors (teal, yellow, white, grey, purple), bold
3. Progress bar - 0% to 100%
4. Estimated time to completion - minutes seconds
5. Increased saliva production during sexy script readouts
6. Automatically resizes with your terminal
7. Simple, chainable, and object oriented API

![Preview of PreTTY output](http://wikifightgame.com/moarcontent/I-Feel-PreTTY.png)

For the moment the only classes are PreTTYProcess and PreTTYDemo

## PreTTYDemo:
Have a nice serenading demo of PreTTYProcess, just run `php demo.php`
to see what the PreTTYDemo object has in store for you.

## PreTTYProcess:
You can have outputting processes use its public methods or extend it.
I usually prefer to extend it.

### Main methods:
* `->say(string $text, string $color = 'grey', boolean $is_bold = false)`
> Available colors are teal, yellow, white, grey, and purple. They will
> not necessarily appear that color on a terminal since most terminals
> let you customize them. If your output is not indented, bold actually
> defaults to true.

* `->indent()`
> Indent the following calls of `->say()`

* `->outdent()`
> de-Indent the following calls of `->say()`

* `->setTasks(integer $amount)`
> progress bar and time estimate is generated by comparing the amount
> provide here to how many times you've called `->completeTask()`

* `->completeTasks()`
> The progress bar and time estimate is generated by tracking how many
> tasks you've marked completed with this function, to how many total
> tasks you set with `->setTasks()`

### Optional features:
* Progress Bar - ON by default
> Shows your percentage complete and estimated remaining time. You
> can disable this by calling `->hideProgressBar()`

* Cache Header - OFF by default
> Saves your 'breadcrumbs' and displays them at the top of the
> output. you can enable this by calling `->showCacheHeader()`
