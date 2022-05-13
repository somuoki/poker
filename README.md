
<h2> <center>Five - Card Poker Simulation </center></h2>

This Application is a cli simulation of the five-card poker variant. 
The application uses php(Laravel Zero).

------

## Documentation

### Installation
Clone or download the repository
```
# git clone https://github.com/somuoki/poker.git
# cd poker
# Composer install
```

### Running the project
There are two cmd files on the root of the project

- localpoker.cmd
- dockerpoker.cmd

This file allows you to run the application directly either in docker or locally on your cmd
The other option is to just open a terminal from the root of the project

### Usage
The commands for the game are

```
# php poker

  Poker  1

  USAGE: poker <command> [options] [arguments]

  play           Start Playing Poker

  play:badugi    Play the Badugi Poker Variant
  play:five-card Play the five card poker variant
```

The `php poker` commands lists game play commands

The `play` command gives you a list of available games in which you choose the one to play
```
# php poker play

Which Variant do you want to play:
  [1] Five Card
  [2] Badugi
 > 1
```

The `play:badugi` and `play:five-card` commands take you directly to the game you wish to play

```
# php poker play:five-card
Shuffling... Shuffling... Shuffling...

Your hand: J♠ 5♠ A♠ 2♥ 6♦

You have: High Cards
```

**_NOTE:_** Currently the badugi game is not implemented you are welcome to try to implement it


