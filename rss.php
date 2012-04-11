<?php
if(!defined(BASE_PATH)) define('BASE_PATH', './');
include('static/include.php');

header("Content-type: application/rss+xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title><![CDATA[<?php echo BLOG_TITLE; ?>]]></title>
		<link><?php echo BASE_URL; ?></link>
		<description><![CDATA[<?php echo BLOG_DESCRIPTION; ?>]]></description>
		<docs>http://blogs.law.harvard.edu/tech/rss</docs>
		<generator><![CDATA[<?php echo POWERED_BY; ?>]]></generator>
		<atom:link href="<?php echo PRETTY_URLS ? BASE_URL."/rss/" : BASE_URL."rss.php"; ?>" rel="self" type="application/rss+xml" />

<?
$files = list_posts(BASE_PATH.'posts');
foreach($files as $filename){
	$post = post_details(BASE_PATH."posts/".$filename);
	$html = to_html($post['content']);
	
	$date = $post['date'];
	$link = PRETTY_URLS
		? BASE_URL.$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title'])
		: BASE_URL."?p=".$post['id'];

	date_default_timezone_set(date('T'));
	$rfcdate = date('r', mktime($date['hour'], $date['minute'], 0, $date['month'], $date['day'], $date['year']));
?>

		<item>
			<title><![CDATA[<?php echo htmlspecialchars($post['title']); ?>]]></title>
			<link><?php echo $link; ?></link>
			<description><![CDATA[<?php echo $html ?>]]></description>
			<guid><?php echo $link; ?></guid>
			<pubDate><?php echo $rfcdate; ?></pubDate>
		</item>
<?
}
?>

	</channel>
</rss>