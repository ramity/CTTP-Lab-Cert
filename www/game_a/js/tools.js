function rand(min,max){
  return Math.floor(Math.random()*(max-min+1))+min;
}
function multisearch(needles,haystack){
  for(x=0;x<needles.length;x++)
  {
    for(z=0;z<haystack.length;z++)
    {
      if(haystack[z].toLowerCase()==needles[x])
        return true;
    }
  }
  return false;
}
function search(needle,haystack){
  for(z=0;z<haystack.length;z++)
  {
    if(haystack[z].toLowerCase()==needle)
      return true;
  }
  return false;
}
function multi_lc_input(array)
{
  for(z=0;z<array.length;z++)
  {
    array[z]=array[z].toLowerCase();
  }
  return array;
}
