<?php
include "../secret.php";

function listFiles($acc_id,$uptoboxPath,$recursive){
    $userToken = userTokenFromSecret($acc_id);
    return loadFolderFiles($userToken,$uptoboxPath,$recursive);
}

function userTokenFromSecret($acc_id){
    $secret = SECRET["".$acc_id]["token"];
    return $secret;
}

function loadFileLink($userToken,$fileCode){
    $api_result = CallAPI("GET","https://uptobox.com/api/link",array(
        "token"=>$userToken,
        "file_code"=>$fileCode));

    $result = json_decode($api_result,true); 
    return $result["data"]["dlLink"]    ;
}

function loadFolderFiles($userToken,$uptoboxPath,$recursive){

    $api_result = CallAPI("GET","https://uptobox.com/api/user/files",array(
        "token"=>$userToken,
        "path"=>$uptoboxPath,
        "hash"=>"8f542576b461bb17",
        "orderBy"=>"file_name",
        "dir"=>"asc",
        "offset"=>"0",
        "limit"=>"100"));

        $result = json_decode($api_result,true); 
        $files = $result["data"]["files"];
        $folders = $result["data"]["folders"];
        
        $linksResult = array();
        if(count($files)>0){
            foreach($files as $file){
                $file["dlLink"] = loadFileLink($userToken,$file["file_code"]);
                array_push($linksResult,$file);
            }            
        }
        if($recursive && count($folders)>0){
            foreach($folders as $folder){
                // on récupère les fichiers des sous dossiers récursivement
                $files = loadFolderFiles($userToken,$folder["fullPath"],$recursive);
                foreach($files as $file){
                    $file["dlLink"] = loadFileLink($userToken,$file["file_code"]);
                    array_push($linksResult,$file);
                }            
            }
        }
    return $linksResult;
}

function formatFileSizeToMo($fileSize){
    return round($fileSize / 1024 / 1024 , 2);
}

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>