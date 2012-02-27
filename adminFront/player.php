<?php 
		error_reporting(0);
    session_start();
    include('includes/connection.php');
    
    $id = $_GET['id'];
    $type = $_GET['type'];
  
  
    //Live  
    if($type == 1){
        
        $sql_getData = "SELECT DISTINCT lc.*
                        FROM
                         livechannels lc,
                         packages_livechannels pl,
                         subscribers_packages sp
                        WHERE
                         lc.id = pl.resource_id AND
                         lc.id = $id AND 
                         pl.package_id = sp.package_id AND
                         sp.subscriber_id = ".$_SESSION['id'].
                       " ORDER BY lc.number";
                        
        $rs_getData = $DB->Execute($sql_getData);
        
        $url = $rs_getData->fields['url'];
        
    }
    //Vod Local
    elseif($type == 2){
        
        $sql_getData = "SELECT
												 vc.id,
												 vc.name,
												 tc.current_views,
												 rc.max_views,
												 rc.duration,
												 vc.stb_url,
												 vc.local_url
												FROM
												 vodchannels vc,
												 tickets tc,
												 restrictions rc
												WHERE
												 vc.id = tc.resource_id AND
                         vc.id = $id AND 
												 tc.restriction_id  = rc.id AND
												 tc.subscriber_id = ".$_SESSION['id'].
												 " ORDER BY vc.id DESC";
        
        $rs_getData = $DB->Execute($sql_getData);
        
        $url = $rs_getData->fields['local_url'];
    }
    
    //VOD internet
    elseif($type == 3){
        $sql_getData = "SELECT
												 vc.id,
												 vc.name,
												 tc.current_views,
												 rc.max_views,
												 rc.duration,
												 vc.stb_url,
												 vc.pc_url
												FROM
												 vodchannels vc,
												 tickets tc,
												 restrictions rc
												WHERE
												 vc.id = tc.resource_id AND
                         vc.id = $id AND 
												 tc.restriction_id  = rc.id AND
												 tc.subscriber_id = ".$_SESSION['id'].
												 " ORDER BY vc.id DESC";
        
        $rs_getData = $DB->Execute($sql_getData);
        
        $url = $rs_getData->fields['pc_url'];        
    }
    
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
    <title>Welcome to RAMP</title>
    <style type="text/css">
    html, body {
     height: 100%;
     overflow: auto;
    }
    body {
     padding: 0;
     margin: 0;
    }
    #silverlightControlHost {
     height: 100%;
     text-align:center;
    }
    </style>
    <script type="text/javascript">
        function onSilverlightError(sender, args) {
            var appSource = "";
            if (sender != null && sender != 0) {
              appSource = sender.getHost().Source;
            }
            
            var errorType = args.ErrorType;
            var iErrorCode = args.ErrorCode;

            if (errorType == "ImageError" || errorType == "MediaError") {
              return;
            }

            var errMsg = "Unhandled Error in Silverlight Application " +  appSource + "\n" ;

            errMsg += "Code: "+ iErrorCode + "    \n";
            errMsg += "Category: " + errorType + "       \n";
            errMsg += "Message: " + args.ErrorMessage + "     \n";

            if (errorType == "ParserError") {
                errMsg += "File: " + args.xamlFile + "     \n";
                errMsg += "Line: " + args.lineNumber + "     \n";
                errMsg += "Position: " + args.charPosition + "     \n";
            }
            else if (errorType == "RuntimeError") {           
                if (args.lineNumber != 0) {
                    errMsg += "Line: " + args.lineNumber + "     \n";
                    errMsg += "Position: " +  args.charPosition + "     \n";
                }
                errMsg += "MethodName: " + args.methodName + "     \n";
            }

            throw new Error(errMsg);
        }
    </script>
</head>
<body>
    <form id="form1" runat="server" style="height:100%">
    <div id="silverlightControlHost">
        <object data="data:application/x-silverlight-2," type="application/x-silverlight-2" width="100%" height="100%">
        <param name="source" value="SmoothStreamingPlayer.xap"/>
        <param name="onError" value="onSilverlightError" />
        <param name="background" value="white" />
        <param name="minRuntimeVersion" value="4.0.50401.0" />
        <param name="autoUpgrade" value="true" />
        <param name="enableGPUAcceleration" value="true" />
        <param name="InitParams" value="selectedcaptionstream=textstream_eng,mediaurl=<?=$url?>" />
        <a href="http://go.microsoft.com/fwlink/?LinkID=149156&v=4.0.50401.0" style="text-decoration:none">
            <img src="http://go.microsoft.com/fwlink/?LinkId=161376" alt="Get Microsoft Silverlight" style="border-style:none"/>
        </a>
         </object><iframe id="_sl_historyFrame" style="visibility:hidden;height:0px;width:0px;border:0px"></iframe></div>
    </form>
</body>
</html>