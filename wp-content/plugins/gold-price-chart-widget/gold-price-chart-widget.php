<?php
/*
*Plugin Name: Live Gold Price & Silver Price Charts Widgets
*Plugin URI: https://www.goldbroker.com/gold-spot-price-widget
*Description: Live gold and silver price chart widgets. Once activated go to Widgets and drag the Gold Price Chart in the widget area.
*Version: 2.4
*Author: GoldBroker.com
*Author URI:https://www.goldbroker.com
*Text Domain: gold-price-chart-widget
*Domain path: /languages
*/

add_action('plugins_loaded', 'wan_load_textdomain');
function wan_load_textdomain()
{
    load_plugin_textdomain('gold-price-chart-widget', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}


    abstract class gb_widget extends WP_widget
    {

        abstract protected function get_options();
        abstract protected function get_html($instance);

        function __construct()
        {

            $options=$this->get_options();
            parent::__construct(get_called_class(), $options['name'], array(
                "classname" => get_called_class(),
                "description" => $options['description'],
            ));
        }

	    function widget($args,$instance){
		    $instance = wp_parse_args( (array) $instance, $this->get_options() );
		    extract($args);
		    echo $before_widget;
		    echo $this->get_html($instance);
		    echo $after_widget;
        }

        public function get_currencies(){
            return array(
                'AED',
                'ANG',
                'ARS',
                'AUD',
                'AWG',
                'AZN',
                'BAM',
                'BBD',
                'BDT',
                'BGN',
                'BMD',
                'BOB',
                'BRL',
                'BSD',
                'BTC',
                'BYR',
                'BZD',
                'CAD',
                'CDF',
                'CHF',
                'CLF',
                'CLP',
                'CNH',
                'CNY',
                'COP',
                'CRC',
                'CUP',
                'CVE',
                'CZK',
                'DJF',
                'DKK',
                'DOP',
                'DZD',
                'EGP',
                'EUR',
                'FJD',
                'GBP',
                'GIP',
                'GTQ',
                'GYD',
                'HKD',
                'HRK',
                'HUF',
                'IDR',
                'ILS',
                'INR',
                'IRR',
                'ISK',
                'JMD',
                'JPY',
                'KES',
                'KGS',
                'KHR',
                'KPW',
                'KRW',
                'KWD',
                'KYD',
                'KZT',
                'LAK',
                'LBP',
                'LTC',
                'LTL',
                'LVL',
                'LYD',
                'MAD',
                'MGA',
                'MKD',
                'MMK',
                'MNT',
                'MOP',
                'MUR',
                'MVR',
                'MXN',
                'MXV',
                'MYR',
                'NIO',
                'NOK',
                'NZD',
                'OMR',
                'PAB',
                'PEN',
                'PGK',
                'PHP',
                'PKR',
                'PLN',
                'PYG',
                'QAR',
                'RON',
                'RSD',
                'RUB',
                'SAR',
                'SBD',
                'SCR',
                'SEK',
                'SGD',
                'SHP',
                'SYP',
                'THB',
                'TMT',
                'TND',
                'TRY',
                'TTD',
                'TWD',
                'TZS',
                'UAH',
                'USD',
                'UYU',
                'UZS',
                'VEF',
                'VND',
                'XAF',
                'XCD',
                'XDR',
                'XOF',
                'XPF',
                'YER',
                'ZAR',
                'ZWL',
            );
        }

	    public function get_weights(){
		    return array(
			    'oz',
			    'g',
			    'kg',
		    );
	    }


    }



    abstract class gb_chart_widget extends gb_widget
    {

        /**
         * @param $instance
         */


	    function widget($args,$instance){
		    $instance = wp_parse_args( (array) $instance, $this->get_options() );
		    extract($args);
		    echo $before_widget;
		    echo $before_title.$instance["title"].$after_title;
		    echo $this->get_html($instance);
		    echo $after_widget;
	    }


	    function form($instance)
        {
            $options=$this->get_options();
            $instance = wp_parse_args( (array) $instance, $this->get_options());
            $title = $instance['title'];
            $current_currency = $instance['currency'];
	        $current_weight = $instance['weight'];
            $height = $instance['height'];
            $width = $instance['width'];

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'gold-price-chart-widget'); ?>: </label>
                <input value="<?php echo $instance["title"]; ?>" name="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_id('title'); ?>" type="text"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('currency'); ?>"><?php echo __('Select currency', 'gold-price-chart-widget'); ?>:
                    <select  id="<?php echo $this->get_field_id('currency'); ?>" name="<?php echo $this->get_field_name('currency'); ?>" type="text">


                        <?php foreach($this->get_currencies() as $currency): ?>

                            <option value="<?php echo $currency ?>"<?php echo ($currency==$current_currency)?' selected':''; ?>><?php echo $currency ?> </option>

                        <?php endforeach; ?>

                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('weight'); ?>"><?php echo __('Select Weight Unit', 'gold-price-chart-widget'); ?>:
                    <select  id="<?php echo $this->get_field_id('weight'); ?>" name="<?php echo $this->get_field_name('weight'); ?>" type="text">


				        <?php foreach($this->get_weights() as $weight): ?>

                        <option value="<?php echo $weight ?>"<?php echo ($weight==$current_weight)?' selected':''; ?>><?php echo $weight ?> </option>

				        <?php endforeach; ?>

                    </select>
                </label>
            </p>


            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php echo __('Height', 'gold-price-chart-widget'); ?>: </label>
                <input value="<?php echo $instance["height"]; ?>" name="<?php echo $this->get_field_name('height'); ?>" name="<?php echo $this->get_field_id('height'); ?>" type="text"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('width'); ?>"><?php echo __('Width', 'gold-price-chart-widget'); ?>: </label>
                <input value="<?php echo $instance["width"]; ?>" name="<?php echo $this->get_field_name('width'); ?>" name="<?php echo $this->get_field_id('width'); ?>" type="text"/>
            </p>

            <?php

        }

        protected function get_html($instance)
        {
            ?>
            <iframe src="https://<?php echo __('www.goldbroker.com','gold-price-chart-widget')?>/widget/iframe/<?php echo $instance['chart_type']?>/<?php echo $instance['metal_code']?>/<?php echo $instance["height"]; ?>?currency=<?php echo $instance["currency"]; ?>&weight_unit=<?php echo $instance["weight"]; ?>" width="<?php echo $instance["width"]; ?>" height="<?php echo $instance["height"]; ?>" style="border: 0; overflow:hidden;"></iframe><br /><?php echo $instance['name']?> <?php echo __('by','gold-price-chart-widget')?> <a href="https://<?php echo __('www.goldbroker.com','gold-price-chart-widget')?>"><?php echo __('Goldbroker.com','gold-price-chart-widget')?></a>
            <?php
        }
    }


    abstract class gb_table_widget extends gb_widget
    {

	/**
	 * @param $instance
	 */
	function form($instance)
	{
		$options=$this->get_options();
		$instance = wp_parse_args( (array) $instance, $this->get_options());
		$current_currency = $instance['currency'];
		$current_weight = $instance['weight'];
		$width = $instance['width'];

		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'gold-price-chart-widget'); ?>: </label>
            <input value="<?php echo $instance["title"]; ?>" name="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_id('title'); ?>" type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('currency'); ?>"><?php echo __('Select currency', 'gold-price-chart-widget'); ?>:
                <select  id="<?php echo $this->get_field_id('currency'); ?>" name="<?php echo $this->get_field_name('currency'); ?>" type="text">


					<?php foreach($this->get_currencies() as $currency): ?>

                        <option value="<?php echo $currency ?>"<?php echo ($currency==$current_currency)?' selected':''; ?>><?php echo $currency ?> </option>

					<?php endforeach; ?>

                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('weight'); ?>"><?php echo __('Select Weight Unit', 'gold-price-chart-widget'); ?>:
                <select  id="<?php echo $this->get_field_id('weight'); ?>" name="<?php echo $this->get_field_name('weight'); ?>" type="text">


					<?php foreach($this->get_weights() as $weight): ?>

                    <option value="<?php echo $weight ?>"<?php echo ($weight==$current_weight)?' selected':''; ?>><?php echo $weight ?> </option>

					<?php endforeach; ?>

                </select>
            </label>
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php echo __('Width', 'gold-price-chart-widget'); ?>: </label>
            <input value="<?php echo $instance["width"]; ?>" name="<?php echo $this->get_field_name('width'); ?>" name="<?php echo $this->get_field_id('width'); ?>" type="text"/>
        </p>

		<?php

	}

	protected function get_html($instance)
	{
		?>
        <iframe src="https://<?php echo __('www.goldbroker.com','gold-price-chart-widget')?>/widget/table/XAU,XAG,XPD,XPT?currency=<?php echo $instance["currency"]; ?>&weight_unit=<?php echo $instance["weight"]; ?>" width="<?php echo $instance["width"]; ?>" height="220" style="border: 0; overflow: hidden;"></iframe><br /><?php echo $instance['name']?> <?php echo __('by','gold-price-chart-widget')?> <a href="https://<?php echo __('www.goldbroker.com','gold-price-chart-widget')?>"><?php echo __('Goldbroker.com','gold-price-chart-widget')?></a>
		<?php
	}
}




    abstract class gb_live_price_widget extends gb_widget
    {

        /**
         * @param $instance
         */
        function form($instance)
        {
            $options=$this->get_options();
            $instance = wp_parse_args( (array) $instance, $this->get_options());
            $title = $instance['title'];
            $current_currency = $instance['currency'];
            $current_weight = $instance['weight'];

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'gold-price-chart-widget'); ?>: </label>
                <input value="<?php echo $instance["title"]; ?>" name="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_id('title'); ?>" type="text"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('currency'); ?>"><?php echo __('Select currency', 'gold-price-chart-widget'); ?>:
                    <select  id="<?php echo $this->get_field_id('currency'); ?>" name="<?php echo $this->get_field_name('currency'); ?>" type="text">


                        <?php foreach($this->get_currencies() as $currency): ?>

                            <option value="<?php echo $currency ?>"<?php echo ($currency==$current_currency)?' selected':''; ?>><?php echo $currency ?> </option>

                        <?php endforeach; ?>

                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('weight'); ?>"><?php echo __('Select Weight Unit', 'gold-price-chart-widget'); ?>:
                    <select  id="<?php echo $this->get_field_id('weight'); ?>" name="<?php echo $this->get_field_name('weight'); ?>" type="text">


				        <?php foreach($this->get_weights() as $weight): ?>

                            <option value="<?php echo $weight ?>"<?php echo ($weight==$current_weight)?' selected':''; ?>><?php echo $weight ?> </option>

				        <?php endforeach; ?>

                    </select>
                </label>
            </p>


            <?php

        }

        protected function get_html($instance)
        {
            ?>
            <iframe src="https://<?php echo __('www.goldbroker.com', 'gold-price-chart-widget'); ?>/widget/live-price/<?php echo $instance['metal_code']?>?currency=<?php echo $instance["currency"]; ?>&weight_unit=<?php echo $instance["weight"]; ?>" width="100%" height="130" style="border: 0; overflow:hidden;"></iframe>
            <?php
        }
    }


    class gb_silver_chart_widget extends gb_chart_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live Silver Price", "gold-price-chart-widget"),
                'title' => __( "Silver Price", "gold-price-chart-widget"),
                'description'=> __( "Live silver price chart", "gold-price-chart-widget"),
                'chart_type'=> 'live',
                'metal_code'=>'XAG',
                'currency' => 'USD',
                'height' => '320',
                'width' => '100%',
                'weight' => 'oz',
            );
        }
    }

    class gb_gold_chart_widget extends gb_chart_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live Gold Price", "gold-price-chart-widget"),
                'title' => __( "Gold Price", "gold-price-chart-widget"),
                'description'=> __( "Live gold price chart", "gold-price-chart-widget"),
                'chart_type'=> 'live',
                'metal_code'=>'XAU',
                'currency' => 'USD',
                'height' => '320',
                'width' => '100%',
                'weight' => 'oz',
            );
        }
    }

    class gb_palladium_chart_widget extends gb_chart_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live Palladium Price", "gold-price-chart-widget"),
                'title' => __( "Palladium Price", "gold-price-chart-widget"),
                'description'=> __( "Live palladium price chart", "gold-price-chart-widget"),
                'chart_type'=> 'live',
                'metal_code'=>'XPD',
                'currency' => 'USD',
                'height' => '320',
                'width' => '100%',
                'weight' => 'oz',
            );
        }
    }

    class gb_platinum_chart_widget extends gb_chart_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live Platinum Price", "gold-price-chart-widget"),
                'title' => __( "Platinum Price", "gold-price-chart-widget"),
                'description'=> __( "Live platinum price chart", "gold-price-chart-widget"),
                'chart_type'=> 'live',
                'metal_code'=>'XPT',
                'currency' => 'USD',
                'height' => '320',
                'width' => '100%',
                'weight' => 'oz',
            );
        }
    }

    class gb_all_metals_table_widget extends gb_table_widget
    {
  	    protected function get_options()
	    {
		    return array(
			    'name'=> __( "Precious Metals Spot Prices", "gold-price-chart-widget"),
			    'description'=> __( "Gold, Silver, Palladium and Platinum spot prices and daily change", "gold-price-chart-widget"),
		    	'currency' => 'USD',
		    	'width' => '400',
			    'weight' => 'oz',
		    );
	    }
    }

    class gb_silver_live_price_widget extends gb_live_price_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live 1 ounce Silver Price", "gold-price-chart-widget"),
                'title' => __( "Silver Price", "gold-price-chart-widget"),
                'description'=> __( "Live 1 ounce Silver Price", "gold-price-chart-widget"),
                'metal_code'=>'XAG',
                'currency' => 'USD',
                'weight' => 'oz',
            );
        }
    }

    class gb_gold_live_price_widget extends gb_live_price_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live 1 ounce Gold Price", "gold-price-chart-widget"),
                'title' => __( "Gold Price", "gold-price-chart-widget"),
                'description'=> __( "Live 1 ounce Gold Price", "gold-price-chart-widget"),
                'metal_code'=>'XAU',
                'currency' => 'USD',
                'weight' => 'oz',
            );
        }
    }


    class gb_palladium_live_price_widget extends gb_live_price_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live 1 ounce Palladium Price", "gold-price-chart-widget"),
                'title' => __( "Palladium Price", "gold-price-chart-widget"),
                'description'=> __( "Live 1 ounce Palladium Price", "gold-price-chart-widget"),
                'metal_code'=>'XPD',
                'currency' => 'USD',
                'weight' => 'oz',
            );
        }
    }

    class gb_platinum_live_price_widget extends gb_live_price_widget
    {
        protected function get_options()
        {
            return array(
                'name'=> __( "Live 1 ounce Platinum Price", "gold-price-chart-widget"),
                'title' => __( "Platinum Price", "gold-price-chart-widget"),
                'description'=> __( "Live 1 ounce Platinum Price", "gold-price-chart-widget"),
                'metal_code'=>'XPT',
                'currency' => 'USD',
                'weight' => 'oz',
            );
        }
    }

    foreach(get_declared_classes() as $class){
        $reflection_class= new ReflectionClass($class);


        if ($reflection_class->isSubclassOf('gb_widget' ) && $reflection_class->isInstantiable())  {
            add_action('widgets_init', function () use ($class) {
                register_widget($class);
            });
        }
    }