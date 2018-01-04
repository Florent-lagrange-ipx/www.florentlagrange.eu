<?

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
    $thisfile, //Plugin id
    'RSS Import',     //Plugin name
    '0.1a',         //Plugin version
    'Kenni Andruszkow Poulsen',  //Plugin author
    'http://www.tundramusic.dk/', //author website
    '<p>Import RSS feeds, and show their headlines as links in a sidebar section, typically through "Theme -> Components". </p><p><b>Usage example</b></p><code>&lt;h2&gt;External news&lt;/h2&gt;<br />&lt;?php rss_display() ?&gt;;</code>', //Plugin description
    'plugins', //page type - on which admin tab to display
    'rss_display_show'  //main function (administration)
);

# add a link in the admin tab 'theme'
add_action('plugins-sidebar','createSideMenu',array($thisfile,'RSS Import management'));

# Error message function
function rssError($errMsg) {
    $errorMessage = array(
    '<b>Error:</b> URL Empty. You need to type a valid URL',
    '<b>Error:</b> Value for number of items cannot be empty'
    );
    return($errorMessage[$errMsg]);
}

// Did we receive an feed_id for deletion?
 if(isset($_POST['feed_id'])){

    // Declare location of XML file
    $rss_feed_xml = GSDATAOTHERPATH . basename(__FILE__, ".php") . "/rss_import.xml";
    $searchString = $_POST['feed_id'];
    
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($rss_feed_xml);
    $xpath = new DOMXpath($xmlDoc);
    # Search for the <feed> tag with the correct ID
    $nodeList = $xpath->query('//feed[@id="'.$searchString.'"]');
    if ($nodeList->length) 
    {
        # We found it, now remove it
        $node = $nodeList->item(0);
        $node->parentNode->removeChild($node);
    }
    #Save changes to XML-file
    $xmlDoc->save($rss_feed_xml);
}       

  
// The very main Function
function rss_display(){
   
   # Basic vars
   $news_counter = 0;
   $rss_feed_xml = GSDATAOTHERPATH . basename(__FILE__, ".php") . "/rss_import.xml";
   
   # Get XML file and store as $feed
   $feed = simplexml_load_file($rss_feed_xml);
   
   # Run through XML and display feeds
   foreach($feed as $rss_feed){
       
       $rss_news_url = simplexml_load_file($rss_feed->url);
       $news_counter = 0;
              
       foreach($rss_news_url->channel->item as $display_news){
           while($news_counter<$rss_feed->items){
               print "<a target='_blank' href='$display_news->link'>{$display_news->title}</a><br/>";
               print "<i>$display_news->pubDate </i><br/>";
               # Future functionality, to show part of the news. Option should be manageable
               # print substr($display_news->description . "<br/><br/>",0,150)."...<br /><br />";
               #
               break;                                                                                                            
           }
        $news_counter ++;
       }                 
   }
}

// Viser indhold på admin siden. Starter med at oprette dir og XML fil hvis det er en ny installation
function rss_display_show() {
    
    $pluginPath = GSDATAOTHERPATH . basename(__FILE__, ".php");
    
    if(!file_exists($pluginPath)){ // Check if plugin directory exists. If not, create dir+default XML
        
        echo '<div class="updated">Path did not exist: <i>' . $pluginPath . '</i> - Created.<br />XML with default feed - Created.</div>';
        mkdir($pluginPath, 0755); // Create the directory
        
        // Create the default XML-file
        $filename = $pluginPath . "/rss_import.xml";
        $filehandle = fopen($filename, 'w') or die("can't open file");
        
        # Write data of default XML
        $fileData = '<?xml version="1.0" encoding="iso-8859-1"?>
<feeds>
    <feed id="http://www.tundramusic.dk/feed/">
        <url>http://www.tundramusic.dk/feed/</url>
        <items>3</items>
    </feed>
</feeds>';
        fwrite($filehandle, $fileData);
        fclose($filehandle);
    }
    
    echo '<h3>RSS Import management</h3>';
    
    // Check for $_POST event from adding a feed
    
    if(isset($_POST['add_feed'])){
        
        if(!$_POST['feed_url'])
        {
            # If URL empty, display error
            echo '<div class="error">'.rssError(0).'</div>';                   
        } elseif(!$_POST['feed_items']) {
            # If items empty, display error
            echo '<div class="error">'.rssError(1).'</div>';
        }else {
        
            $rss_feed_xml = GSDATAOTHERPATH . basename(__FILE__, ".php") . "/rss_import.xml";
            $xmldoc = new DOMDocument();
            $xmldoc->formatOutput = true;
            $xmldoc->load($rss_feed_xml);

            $new_url = $_POST['feed_url'];
            $new_url_items = $_POST['feed_items'];
            
            $root = $xmldoc->documentElement;
            $news = $xmldoc->createElement("feed");
            
            # Start adding elements
            $news_url = $xmldoc->createElement("url",$new_url);
            $news->appendChild($news_url);
            $news->setAttribute("id",$new_url);
            $news_items = $xmldoc->createElement("items",$new_url_items);
            $news->appendChild($news_items);
            # Add changes within root element
            $root->appendChild($news);
            $xmldoc->save($rss_feed_xml);
        }      
    }
?>

        
        
        <p>
        <form action="<?php echo $_SERVER ['REQUEST_URI']; ?>" method="post">&nbsp;
        <input type="hidden" name="add_feed" />
        <table>
        <tr><td>
        <label for="feed_url">Add RSS Feed URL</label></td>
        <td>
        <input id="feed_url" type="text" size="60" name="feed_url" /> </td>
        </tr>
        <tr><td>
        <label for="feed_items">How many items for feed (eg.: 3)</label></td>
        
        <td>
        <input id="feed_items" type="text" size="4" name="feed_items" /></td>
        </tr>
        </table>
        </p>
        <input type="submit" style="background-color: #fff; border: #999 solid 1px; font-size: 12px;" value="Save feed" />
        </form>
        <br /><br />

<?php
    // Admin page content start
    show_current_feeds();
}

# List for admin pages of current feeds
function show_current_feeds(){
    
    $rss_feed_xml = GSDATAOTHERPATH . basename(__FILE__, ".php") . "/rss_import.xml";    
    $show_feeds = simplexml_load_file($rss_feed_xml);
    
    echo '<table class="edittable">
          <tr><th width="80%">URL to RSS feed</th><th width="">Items</th><th>Remove</th></tr>';
                                       
    foreach($show_feeds as $current_feed){
    ?>    
        <tr class="enabled">
        <td><?php echo $current_feed->url; ?></td>
        <td align="center"><?php echo $current_feed->items; ?></td>
        <td><form action="<?php echo $_SERVER ['REQUEST_URI']; ?>" method="post">
        <input type="hidden" name="feed_id" value="<?php echo $current_feed->url; ?>" />
        <input type="submit" style="background-color: #fff; border: 0;" value="&times;" title="Delete" />
        </form></td>
        </tr>
    <?php 
    }
    echo '</table>';  
}
?>