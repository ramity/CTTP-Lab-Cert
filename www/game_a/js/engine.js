window.onload=function(){
  window.input=document.getElementById('input');
  window.output=document.getElementById('output');
  output.innerHTML=window.messages['firstload'];
}
window.onkeydown=function(e){
  if(e.keyCode===13){
    process_input(input.value);
    input.value="";
  }
  if(e.keyCode===104){
    //N
  }
  if(e.keyCode===105){
    //NE
  }
  if(e.keyCode===102){
    //E
  }
  if(e.keyCode===99){
    //SE
  }
  if(e.keyCode===98){
    //S
  }
  if(e.keyCode===97){
    //SW
  }
  if(e.keyCode===100){
    //W
  }
  if(e.keyCode===103){
    //NW
  }
}
function process_input(input){
  bits=input.split(" ");
  bits=multi_lc_input(bits);
  if(!game_started)
  {
    if(bits[0]=="begin")
    {
      current_step++;
      output.innerHTML=messages['pick_a_race'];
      return true;
    }
    if(current_step==1)
    {
      if(search(bits[0],core_races))
      {
        output.innerHTML="You have selected: "+bits[0]+"<br><br>"+messages['pick_a_class'];
        current_step++;
        player.selected_race=bits[0];
        return true;
      }
      else
      {
        output.innerHTML="That is not a valid race.<br><br>"+messages['pick_a_race'];
      }
    }
    if(current_step==2)
    {
      if(search(bits[0],core_classes))
      {
        output.innerHTML="You have selected: "+bits[0]+"<br><br>Here are your randomized stats:<br>";
        for(z=0;z<core_stats.length;z++)
        {
          player.stats[core_stats[z]]=rand(1,10);
          output.innerHTML+=core_stats[z]+": "+player.stats[core_stats[z]]+"<br>";
        }
        console.log(player.stats);
        current_step++;
        output.innerHTML+="<br><br>Enter <mark>continue</mark> when you are ready to begin a random adventure.";
        return true;
      }
      else
      {
        output.innerHTML="That is not a valid class.<br>"+messages['pick_a_class'];
      }
    }
    if(current_step==3)
    {
      if(bits[0]=="continue")
      {
        story.theme
      }
      else
      {
        output.innerHTML="I do not recognize this input.<br><br>Enter <mark>continue</mark> when you are ready to begin a random adventure.";
      }
    }
  }
  else
  {
    if(bits[0]=="inventory")
    {
      output_inventory();
    }
  }
}
function output_inventory(){
  output.innerHTML=player.inventory;
}
//Mariner	"Mariners are flamboyant sea-going people, a cross between swashbucklers and sea pirates. They are a cross between rogues (for skills and dirty tricks) and fighters (attack bonus) who have developed at skills specific to those on board ships."
//Master	"Masters are Krynn's enhanced version of experts. More talented, with skills unmatched in their chosen fields, masters are on par with other PC classes. They must specialize in a set of broad skills (craft, knowledge, perform or profession). They receive bonus skill-related feats and special talents akin to feats."
//Mystic	"Mystics are capable of casting divine spells without need of being a cleric; they are mechanically similar to a Sorcerer in that they cast spontaneously, but from a fixed spell list chosen from the spell list for clerics. This ability was important when Krynn was isolated from the gods for a time."
//Nightstalker	"Nightstalkers create magical effects, find traps, and see dead people."
//Noble	"Nobles are charismatic manipulators who leverage skills and connections to advance their goals. They are mechanically similar to rogues without the ability to sneak attack, and can call in favors they earn."
