<?php
function get_config($askfor,$section)
{
  if(file_exists( __DIR__ . '/bend/clc.cfg'))
  {
    $cfg = parse_ini_file( __DIR__ . '/bend/clc.cfg', TRUE);

    if(isset($cfg[$section][$askfor]) && !empty($cfg[$section][$askfor]))
    {
      return $cfg[$section][$askfor];
    }
    else
    {
      return false;
    }
  }
  elseif(file_exists( __DIR__ . '/bend/clc.cfg.local'))
  {
    $cfg = parse_ini_file( __DIR__ . '/bend/clc.cfg.local', TRUE);

    if(isset($cfg[$section][$askfor]) && !empty($cfg[$section][$askfor]))
    {
      return $cfg[$section][$askfor];
    }
    else
    {
      return false;
    }
  }
  else
  {
    die('No known configuration files listed');
  }
}

function getIncludedFiles()
{
  $filenames = get_included_files();

  for($z=0;$z<count($filenames);$z++)
  {
    $filenames[$z] = str_replace(__DIR__,'',$filenames[$z]);
  }

  return $filenames;
}
?>
