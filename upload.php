<?php
    session_start();
    // require 'index.php';

    date_default_timezone_set("Asia/Kolkata");
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]); // full path of file being uploaded
    $uploadOk = 1; // use for error checking
    $fileMaxSize = 10500000; // max file size in bytes to allow for upload => 10500000 B = 10.01 MB
    $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // extension of file in lowercase
    $fileName = pathinfo($target_file,PATHINFO_FILENAME); // filename without extension
    $fileNameWithExtension = $fileName . "." . $fileExtension;
    $fileSize = basename($_FILES["file"]["size"]); // uploaded file size
    
    clearstatcache(); // clear cache
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    } 
    
    // Check file size
    if ($_FILES["file"]["size"] > $fileMaxSize) {
        echo "<br>Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        echo "<br>Sorry, your file was not uploaded.";
    } 
    
    // if everything is ok, try to upload file
    else 
    {
        $username = $_SESSION['username'];
        // connect with db and insert file metadata
        $conn = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conn, "securedatadeduplication");
        // $fileDbHashCheck = "select filehash from user_file_management where fileowner='$username'";
        // $result = mysqli_query($conn, $fileDbHashCheck);
        // $duplicateHash = '';

        // if(mysqli_num_rows($result > 0)
        // {
        //     while($row = mysqli_fetch_assoc($result)
        //     {
        //         $duplicateHash = $row['filehash'];
        //     }
        // }

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
        {
            $fileHash = md5_file($target_file); // hashvalue of file according to data inside in it            
            // if($fileHash === $duplicateHash)
            // {
            //     echo "Duplicate file found.";
            //     echo "rm -f" . $target_file;
            //     echo "file deleted";
            // }
            // else
            // {
                // clearstatcache();
                // filemtime() returns last modified time of file content changed, 
                // if called earlier it will return unix creation timestamp
                // set date format according to datatype 'datetime'
                $fileDuplicateHash = "select filename, extension from user_file_management where filehash='$fileHash'";
                $row = mysqli_query($conn,$fileDuplicateHash);
                $duplicateFileName = mysqli_fetch_assoc($row);
                $fileLastContentModified = date("Y-m-d H:i:s", filemtime(utf8_decode($target_file)));
                $fileUploadTime = date("Y-m-d H:i:s");
                $edit = 1;
                $public = 0;
                $private = 1;
                
                //echo $row['filename'];
                // echo $username;
                // echo $fileHash; // hash of file
                // echo "<br>" . $fileExtension; // extension
                // echo "<br>" . $fileName; // filename without ext.
                // echo "<br>" . $target_file; // location
                // echo "<br>" . $fileSize; // size
                // echo "<br>" . $fileNameWithExtension; // filename with ext.
                // echo "<br>" . $fileLastContentModified; // last modified time, upload time
                // echo "<br>File permission before: " . substr(decoct(fileperms($target_file)), 2); // convert file permission digit into octal and omit first 2 digit
                // echo substr(sprintf('%o', fileperms('WCMC_PR15_17IT127.pdf')), -4);
                
                clearstatcache();
                // change file permissions, it's working fine in linux not in windows
                // chmod($target_file, 0744);
                // echo "<br>File permission after: " . substr(decoct(fileperms($target_file)), 2);


                $fileDataInsertSql = "insert into user_file_management(fileowner, filename, extension, filehash, filesize_bytes, location, lastupdate, upload_timestamp, edit,public, private) values('$username', '$fileName', '$fileExtension', '$fileHash', $fileSize, '$target_file', '$fileLastContentModified', '$fileUploadTime', $edit, $public, $private)";
                
                if($duplicateFileName)
                {
                    echo "<br>insert failed." . "<br>File already exists with different name: " . $duplicateFileName['filename'].".".$duplicateFileName['extension']; 
                    echo "<br>Duplicate file deleted";
                    // delete duplicate file
                    unlink($target_file);
                }
                else if(!mysqli_query($conn, $fileDataInsertSql))
                {
                    echo "<br>insert failed.";
                    unlink($target_file);
                }
                else
                {
                    echo "<br>data inserted.";
                    header('location: index.php');
                }
            // }
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
        //header('location:index.php');    
    }
?>
