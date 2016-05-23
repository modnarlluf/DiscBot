Presentation
=

This repository is a set of examples on how to use the [DiscordPHP](https://github.com/teamreflex/DiscordPHP) library to grant full power to your bots !

Installation
=

```bash
composer install
cp app/config.php.dist app/config.php   # don't forget to edit your configuration
```

Usage
=

Start the bot:
```bash
php bot.php
```

Commandes
=

- `!cat` sends a random picture of a cat, thanks to [the cat api](http://thecatapi.com).
- `!tg` or `!tagueule` sends a link to [this gif](http://i.imgur.com/3CKPQ4W.gif).
- If a message contains `http://onlywat.ch`, the bot sends the same gif as above.
- `!ow.timeleft` shows the remaining time before [Overwatch](https://playoverwatch.com/en-us/)'s launch.
- `!dice 1d20+5` is a RPG tool to throw dice. You can use shortcuts like `!dice 20+3` (⇔ `!dice 1d20+3`) or `!dice 18` (⇔ `!dice 1d18+0`)
- `!nms.timeleft` shows the remaining time before [No Man's Sky](http://www.no-mans-sky.com/)'s launch.
- `!prepareyouranus` or `!beprepared` sends a link to [this image](http://memestorage.com/_nw/22/79844313.jpg).