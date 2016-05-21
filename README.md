Presentation
=

This repository is a set of examples on how to use the [DiscordPHP](https://github.com/teamreflex/DiscordPHP) library to grant full power to your bots !

Installation
=

Don't forget to create a config file:

```bash
cp config.php.dist config.php
```

Usage
=

Start the bot:
```bash
php index.php
```

Commandes
=

- `!cat` sends a random picture of a cat, thanks to [the cat api](http://thecatapi.com).
- `!tg` or `!tagueule` sends a link to [this gif](http://i.imgur.com/3CKPQ4W.gif).
- If a message contains `http://onlywat.ch`, the bot sends the same gif as above.
- `!ow.timeleft` shows the remaining time before [Overwatch](https://playoverwatch.com/en-us/)'s launch.
- `!dice 1d20+5` is a RPG tool to throw dice. You can use shortcuts like `!dice 20+3` (⇔ `!dice 1d20+3`) or `!dice 18` (⇔ `!dice 1d18+0`)