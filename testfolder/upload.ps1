#local dir
$Dir= Get-ChildItem "C:\Users\James\Documents\Visual Studio 2012\Projects\ATA\ata\"
Write-Host $Dir
#ftp server 
$ftp = "ftp://ftp.streamline.net/htdocs/blog/wp-content/themes/ata/testfolder/" 
Write-Host "Connecting to: " $ftp
$user = "firststrikecomputing.co.uk" 
$pass = "stephen1"  
Write-Host "Connecting user: " $user
 
$webclient = New-Object System.Net.WebClient 
 
$webclient.Credentials = New-Object System.Net.NetworkCredential($user,$pass)  
 
#list every sql server trace file 
# foreach($item in (dir $Dir "*.trc")){ 
foreach($item in (dir $Dir)){
    Write-Host "Uploading $item..." 
    $uri = New-Object System.Uri($ftp+$item.Name) 
    $webclient.UploadFile($uri, $item.FullName) 
 } 