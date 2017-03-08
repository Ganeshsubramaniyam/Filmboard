<?php
$url = $_POST["urlval"];
//$url ="https://youtube.com/4TPmRvWTAbY" ;
$overtags=get_meta_tags($url);
$overalltags=null;
if(isset($overtags["description"]))
{
    $overalltags["description"]=$overtags["description"];
}
if(isset($overtags["author"]))
{
    $overalltags["author"]=$overtags["author"];
}
if(isset($overtags["copyright"]))
{
    $overalltags["copyright"]=$overtags["copyright"];
}
if(isset($overtags["thumbnail"]))
{
    $overalltags["thumbnail"]=$overtags["thumbnail"];
}
if(isset($overtags["application-name"]))
{
    $overalltags["application_name"]=$overtags["application-name"];
}

$overalltags["twitter_card"]=$overtags["twitter:card"];
$overalltags["twitter_title"]=$overtags["twitter:title"];
$overalltags["twitter_description"]=$overtags["twitter:description"];
$overalltags["twitter_image"]=$overtags["twitter:image"];
if(isset($overtags["siteurl"]))
{
    $overalltags["twitter_url"]=$overtags["siteurl"];
}
$overalltags["twitter_site"]=$overtags["twitter:site"];
$site_html = file_get_contents($url);
$facebookmatches = null;
$twittermatches = null;
preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i', $site_html, $facebookmatches);
preg_match_all('~<\s*meta\s+name="(twitter:[^"]+)"\s+content="([^"]*)~i', $site_html, $twittermatches);
$ogtags = array();
$twittertags = array();
for ($i = 0; $i < count($facebookmatches[1]); $i++) {
    $ogtags[str_replace(":","_",$facebookmatches[1][$i])] = $facebookmatches[2][$i];
}
for ($i = 0; $i < count($twittermatches[1]); $i++) {
    $twittertags[str_replace(":","_",$twittermatches[1][$i])] = $twittermatches[2][$i];
}
$result=array_merge($ogtags,$twittertags);
$result1=array_merge($overalltags,$result);
echo json_encode($result1);
?>