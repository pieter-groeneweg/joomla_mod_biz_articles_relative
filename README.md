# joomla_mod_biz_articles_relative
Show Articles Relative to x days before created date and keep alive x day(s) after

The module sprung to mind by an idea of sseguin. See https://forum.joomla.org/viewtopic.php?p=3548925
sseguin uses creation date as the date an event occurs.

Scanning the Joomla! core modules, module Most Read (mod_articles_popular) came close to the idea.
From that point I reversed engineered and rewrote some pieces of that module into a new one.

## How it works

In content article editor write (an) articles and set a creation date when your 'event' is on. Save your article.

In the module
1. select the categories and article count
2. set the article count
3. set the amount of days you want to see the articles (events) in advance.
4. set the amount of days you want to see the articles alive in the module

This does not influence the publishing of articles in any other component or module. 
The philosphy is to change or add as little as possible to the exisiting workflow.
Though an idea might be to use custom fields for this in future.
