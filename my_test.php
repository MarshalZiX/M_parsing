<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>тест</title> 
    </head>
    <body>
        <?php
        include("simplehtmldom\simple_html_dom.php");
    	function get_info($url)
    	{
    		foreach (file_get_html($url) -> find ('div.cat') as $elem)
    		{
    			$order_info = array(
    				'name' => $elem -> find('div.text p.namelink a',0) -> plaintext,
                    'price' => $elem -> find('div.text p.pr strong',0) -> plaintext,
                    'link' => $elem -> find('a',0) -> href,
                    'size' => $elem -> find('div.text p[3]',0) -> plaintext,
    			);		 
    			$orders_info[] = $order_info;
    		}
    		return $orders_info;

    	}

    	foreach (get_info('http://mebel-son.ru/katalog_tovarov/stenki_v_gostinuyu/requestParams/page/2') as $key => $value)
   		{
            $products[] = $value;
   		}
        file_put_contents('test.json', json_encode($products, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        ?>
    </body>
</html>
