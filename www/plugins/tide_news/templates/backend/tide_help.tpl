<div class="tide_logo_admin">
    <img src="<?php echo SITE_URL; ?>plugins/TIDEGetSimple/images/TIDEngine.ico" />
</div>
<h3 class="tide_title_admin"><?php echo i18n_r('tide_news/PLUGINTITLE') . ' ' .i18n_r('tide_news/HELP'); ?></h3>
<h2><?php echo i18n_r('tide_news/HELP_INSTALATION'); ?></h2>
<p>
<ul>
    <li>Upload TIDEngine News/Blog Manager plugin files into <i>"plugins"</i> directory</li>
    <li>You should see in Admin Pannel new tab <i>"NEWS"</i>. Go to News Page.</li>
    <li>Installation is based on simple installation wizard. Follow installation steps.<br /><br />
        <ol>
            <li><b>Successfull Installation</b> - you should see button that link to  <i>"NEWS SETTINGS"</i>.
            There are Default Settinsg. But you should adjust Settings that fit your needs.</li>
            <li><b>Installation Problems</b> - you will get Error Message.
            You must manually create directory and file structure to enable Plugin functionality. <br />
            All files are in <i>"plugins/tide_news/files"</i> directory;
                <ol style="list-style-type:lower-alpha"> 
                    <li>Copy directory <i>"tide_news"</i> into <i>"data"</i> directory.</li>
                    <li>Copy directory <i>"tide_news_feed"</i> into <i>"data/other"</i> directory.</li>
                    <li>Copy file <i>"rss.php"</i> into <i>"templates/"</i> every template folder.</li>
                    <li>Edit file <i>".htaccess"</i> file find line: 
                    <pre class="brush:php;" title="source code">RewriteCond %{REQUEST_FILENAME} !-f</pre>
                    </li>
                </ol>
            </li>
        </ol>   
    </li>
</ul>
Add this code before line:
<pre class="brush:php;" title="source code">
      
################################               
#TIDEngine News Plugin
################################

#TIDEngine RSS Feed
RewriteRule ^rss/(.*)$ ^index.php?id=rss&page=$1 [L]

#TIDEngine Tags
RewriteRule ^tags/([a-zA-Z0-9_-]+)$ ^index.php?id=tags&tide_tags=$1 [L]
RewriteRule ^tags/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)$ ^index.php?id=tags&tide_tags=$1&category=$2 [L]
                                
#TIDEngine Archive
RewriteRule ^archive/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)$ ^index.php?id=archive&tide_archive=$1&category=$2 [L]

#TIDEngine News
RewriteRule ^news/([a-zA-Z0-9_-]+)/page/([a-zA-Z0-9_-]+) ^index.php?id=$1&tide_show_news&page_number=$2 [L]
RewriteRule ^news/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)$ ^index.php?id=$1&tide_show_news&category=$2&news_current=$3 [L]
RewriteRule ^news/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)$ ^index.php?id=$1&tide_show_news&category=$3&news_current=$4&page_number=$2 [L]

################################
#TIDEngine News Plugin
################################
</pre> 

If you do everything right TIDEngine News/Blog Manager should work.
</p>
<h2><?php echo i18n_r('tide_news/HELP_SHORTCODE'); ?></h2>

<p>You can use Shortcodes or PHP tags to initialize all menus and news content.<br />
       
     <h3>News Category/ Pages Content</h3>
     <h2>News Page Content</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_show_news("CATEGORY_SLUG"); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_NEWS::CATEGORY_SLUG}%}
        </pre>
     </ul>
      <b><u>CATEGORY_SLUG</u></b> - Category slug is added/ updated/ removed by Plugin. You do not need to add it manually, except there are some problems with this functionality.
    <br />
     <hr />
     <h2>Latest News Page Content</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_show_news("master"); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_NEWS::MASTER}%}
        </pre>
     </ul>
     <br />
     <hr />
     <h2>Archive Page Content</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_archive($_GET); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_ARCHIVE}%}
        </pre>
     </ul>
     <hr />
     <h2>Tags Page Content</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_tags($_GET); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_TAGS}%}
        </pre>
     </ul>
    <hr />
     <h2>News Page Breadcrumbs</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_news_breadcrumbs(); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_BREADCRUMBS}%}
        </pre>
     </ul>
     <hr /><hr />
     <h3>Latest News Menu</h3>
     <ol>
        <li><b>Menu with News Short Summary:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_news_menu("summary"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_NEWS_MENU::SUMMARY}%} 
                </pre>
            </li>
          </ul></li>
          <li><b>Menu without News Short Summary:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_news_menu("menu"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_NEWS_MENU::MENU}%} 
                </pre>
            </li>
          </ul></li>
     </ol>
     <hr /><hr />
      <h3>Tags Menu</h3>
       <ol>
        <li><b>Site/ General Tags Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_tags_menu("general"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_TAGS_MENU::GENERAL}%} 
                </pre>
            </li>
          </ul></li>
        <li><b>Category Tags Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_tags_menu("category"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_TAGS_MENU::CATEGORY}%}
                </pre>
            </li>
          </ul></li>
     </ol>
      <hr /><hr />
      <h3>Archive Menu</h3>
       <ol>
        <li><b>Site/ General Archive Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_archive_menu("general"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_ARCHIVE_MENU::GENERAL}%} 
                </pre>
            </li>
          </ul></li>
        <li><b>Category Archive Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_archive_menu("category"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_ARCHIVE_MENU::CATEGORY}%}
                </pre>
            </li>
          </ul></li>
     </ol>
     <hr /><hr />
    <h3>RSS Feed Menu</h3>
       <ol>
        <li><b>Site/ General RSS Feed Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_rss_feed_menu("general"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_RSS_MENU::GENERAL}%} 
                </pre>
            </li>
          </ul></li>
        <li><b>Category RSS Feed Menu:</b>
        <ul>
            <li><b>PHP:</b>
                <pre class="brush:php;" title="source code">
                    &#60;?php tide_rss_feed_menu("category"); ?&#62;
                </pre>
            </li>
            <li><b>Shortcode:</b>
                <pre class="brush:php;" title="source code">
                   {%{TIDE_RSS_MENU::CATEGORY}%}
                </pre>
            </li>
          </ul></li>
     </ol>
      <hr /><hr />
     <h3>Share Services</h3>
     <h2>Addthis</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_share_addthis("share_code_1"); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_ADDTHIS::SHARE_CODE_1}%}
        </pre>
     </ul>
     <b><u>share_code_1/ SHARE_CODE_1</u></b> - Are predefined in Share Services Settings
     <hr />
     <h2>ShareThis</h2>
     <ul>
        <li><b>PHP:</b></li>
        <pre class="brush:php;" title="source code">
         &#60;?php tide_share_sharethis("share_code_1"); ?&#62;
         </pre>
        <li><b>Shortcode:</b></li>
        <pre class="brush:php;" title="source code">
        {%{TIDE_SHARETHIS::SHARE_CODE_1}%}
        </pre>
     </ul>
     <b><u>share_code_1/ SHARE_CODE_1</u></b> - Are predefined in Share Services Settings
</p>

