window.player=[[]];
window.player.stats=[];
window.messages=[];
window.messages['firstload']="Welcome to game_a.<br><br>Type <mark>begin</mark> to generate your own custom adventure.";
window.game_started=false;
window.generation_steps=6;
window.current_step=0;
window.core_themes=[
  'Espionage',
  'Action/Adventure',
  'Horror',
  'Comedy',
  'Revenge'
];
window.core_goals=[
  'Retrieve Item',
  'Assassinate Character',
  'Investigate Occurance',
  'Survive Environment',
  'Gain Money',
  'Rescue NPC(s)',
  'Protect NPC(s)',
  'Explore unmapped area',
  'gain power'
];
window.core_story_hooks=[
  'Old Enemy',
  'Transported to a strange place',
  'Mystery character',
  'Mistaken Identity',
  'Old friend',
  'Labyrinth',
  'Corrupted politics',
];
window.core_effects={
  'fire':{
    'coef':{
      'earth':.5,
      'fire':0,
      'ice':2,
      'metal':2,
      'water':.5,
      'wind':.5,
      'wood':2
    }
  },
  'wood':{
    'coef':{
      'earth':2,
      'fire':.5,
      'ice':.5,
      'metal':.5,
      'water':2,
      'wind':2,
      'wood':0
    }
  },
  'earth':{
    'coef':{
      'earth':0,
      'fire':2,
      'ice':2,
      'metal':2,
      'water':.5,
      'wind':.5,
      'wood':.5
    }
  },
  'ice':{
    'coef':{
      'earth':.5,
      'fire':.5,
      'ice':0,
      'metal':.5,
      'water':2,
      'wind':2,
      'wood':2
    }
  },
  'water':{
    'coef':{
      'earth':2,
      'fire':2,
      'ice':.5,
      'metal':2,
      'water':0,
      'wind':.5,
      'wood':.5
    }
  },
  'metal':{
    'coef':{
      'earth':.5,
      'fire':.5,
      'ice':2,
      'metal':0,
      'water':.5,
      'wind':2,
      'wood':2
    }
  },
  'wind':{
    'coef':{
      'earth':2,
      'fire':2,
      'ice':.5,
      'metal':.5,
      'water':2,
      'wind':0,
      'wood':.5
    }
  }
};
window.core_races=[
  'elf',
  'dark-elf',
  'demon',
  'dragonborn',
  'dwarf',
  'gnome',
  'halfling',
  'human',
  'orc'
];
window.core_classes=[
  'warrior',
  'knight',
  'wanderer',
  'theif',
  'bandit',
  'hunter',
  'sorcerer',
  'pyromancer',
  'cleric',
  'deprived'
];
window.core_stats=[
  'stength',
  'perception',
  'endurance',
  'charisma',
  'intelligence',
  'agility',
  'luck'
];
window.messages['pick_a_race']="Select a race:<br>";
for(z=0;z<window.core_races.length;z++)
{
  messages['pick_a_race']+=window.core_races[z]+"<br>";
}
window.messages['pick_a_class']="Select a class:<br>";
for(z=0;z<window.core_classes.length;z++)
{
  messages['pick_a_class']+=window.core_classes[z]+"<br>";
}
