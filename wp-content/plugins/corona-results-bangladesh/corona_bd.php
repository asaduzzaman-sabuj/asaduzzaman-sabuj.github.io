<?php
/*
Plugin Name: Corona Results Bangladesh
Plugin URI: https://coronacase.xyz/wp-plugin
Description: We launching this plugin free of cost so that everyone from all over the world can use this plugin in their website Showing Corona Result of Bangladesh  in their website. This is a completely free plugin just click below given link to download the plugin and also you may follow the given steps to install tine plugin in your website.

Author: SynthiaSoft
Author URI: http://synthiasoft.com/
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Version: 3.6

*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License version 3
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

License Details: http://www.gnu.org/licenses/gpl-3.0.html
*/
// Translate Function By Rumi
 function Corona_Bangla_Convert($number){
     $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","Jan","Feb","Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec","Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","জানুয়ারী","ফেব্রুয়ারী","মার্চ", 
  "এপ্রিল","মে","জুন","জুলাই","আগস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর","ডিসেম্বর","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনিবার","রবিবার");
   
    $bn_number = str_replace($search_array, $replace_array, $number);

    return $bn_number;
}
add_filter( 'plugin_row_meta', 'Corona_Bd_Developer_Rumi', 10, 2 );
 
function Corona_Bd_Developer_Rumi( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'docs'    => '<a href="' . esc_url( 'https://www.facebook.com/rumi.ipl/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Developer', 'domain' ) . '" style="color:green;">' . esc_html__( 'Developed By: Rashedul Hague Rumi', 'domain' ) . '</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}


function Corona_bdData(){
    $endPoint   = 'http://api.coronacase.xyz/';
            $methodPath = 'bd.php';
            $endPoint = $endPoint.$methodPath;

            $argment = array(
                'timeout' => 60
            ); 

            $request = wp_remote_get($endPoint, $argment);
            $body = wp_remote_retrieve_body( $request );
            
            return $body;
}
function Corona_worldData(){
    $endPoint   = 'http://api.coronacase.xyz/';
            $methodPath = 'world.php';
            $endPoint = $endPoint.$methodPath;

            $argment = array(
                'timeout' => 60
            ); 

            $request = wp_remote_get($endPoint, $argment);
            $body = wp_remote_retrieve_body( $request );
            
            return $body;
}
// getdata from api
// http://coronacase.xyz/ This Is our Own Server Ulr , We are  Useing This link To provide Live Update oF corona Cases In Bangladesh 
function Corona_Cases_Data($perm = "cases"){
            

            return Corona_Bangla_Convert($perm);
        }

function Corona_Cases_Data_world($perm){
    return $perm;
}
/**
* to enqueue scripts and styles.
*/
$rumi ="test";
function corona_bd()
{
    wp_enqueue_style('solaiman-lipi-css', '//fonts.maateen.me/solaiman-lipi/font.css');
    wp_enqueue_style('corona-css', plugin_dir_url(__FILE__) . 'corona.css',array(),time());
}
add_action('wp_enqueue_scripts', 'corona_bd');



/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action('widgets_init', 'corona_bd_int');

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function corona_bd_int()
{
    register_widget('corona_bd_widget');
    register_widget('corona_bd_widget_world');
}


/* * ******************************************************** */

class corona_bd_widget extends WP_Widget{
    // class constructor
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'corona_case_widget',
            'description' => 'This Is free Plugin For Display Corona Case Result'
        );
        parent::__construct('corona_bd_widget', 'বাংলাদেশে করোনাভাইরাস', $widget_ops);
    }
    
    // output the widget content on the front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
            $data = json_decode(Corona_bdData());
                   ?>
<div class="corona-widget">
<div class="warp"><div class="corona-col clogo">
<div class="virus-logo">
<h2><small>বাংলাদেশে</small> <br> করোনাভাইরাস </h2>
</div>
</div>
</div>
 
<div class="lasttf">সর্বশেষ (গত ২৪ ঘন্টার রিপোর্ট)</div>
<div class="coronaTable">
<div class="coronaTableBody">
<div class="coronaTableRow">
<div class="coronaTableCell" style="font-size: 20px;background: #00A79D;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">আক্রান্ত</div>
<div class="coronaTableCell" style="font-size: 20px;background: #ED1C24;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">মৃত্যু</div>
<div class="coronaTableCell" style="font-size: 20px;background: #8DC63F;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">সুস্থ</div>
<div class="coronaTableCell" style="font-size: 20px;background: #27AAE1;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">পরীক্ষা</div>
</div>

<div class="coronaTableRow">
<div class="coronaTableCell aff"><?php echo Corona_Bangla_Convert(number_format($data->todayCases));?></div>
<div class="coronaTableCell mmmm"><?php echo Corona_Bangla_Convert(number_format($data->todayDeaths));?></div>
<div class="coronaTableCell ss"><?php echo Corona_Bangla_Convert(number_format($data->todayRecover));?></div>
<div class="coronaTableCell tt"><?php echo Corona_Bangla_Convert(number_format($data->todayTests));?></div>
</div>
</div>

</div>
<div class="lasttf">সর্বমোট</div>
<div class="coronaTable">
<div class="coronaTableRow">
<div class="coronaTableCell aff"><?php echo Corona_Bangla_Convert(number_format($data->cases));?></div>
<div class="coronaTableCell mmmm"><?php echo Corona_Bangla_Convert(number_format($data->deaths));?></div>
<div class="coronaTableCell ss"><?php echo Corona_Bangla_Convert(number_format($data->recovered));?></div>
<div class="coronaTableCell tt"><?php echo Corona_Bangla_Convert(number_format($data->tests));?></div>
</div>
</div>
<div style="background: black; text-align: center;font-family: solaimanlipi"><a style="color: white;text-decoration: none;" href="https://coronacase.xyz/">তথ্য সূত্রঃ করোনা কেইস বাংলাদেশ</a></div>

</div>


<!-- <-------------end -------- -->
       <?php
       echo $args['after_widget'];
    }
    
    // output the option form field in admin Widgets screen
    
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('বাংলাদেশে কোরোনা
', 'rumi');
         $rtf = !empty($instance['rtf']) ? $instance['rtf'] : esc_html__('10', 'rumi');
         $rhf = !empty($instance['rhf']) ? $instance['rhf'] : esc_html__('20', 'rumi');
        $fcolor = !empty($instance['fcolor']) ? $instance['fcolor'] : esc_html__('#fff', 'rumi');
        $bgcolor = !empty($instance['bgcolor']) ? $instance['bgcolor'] : esc_html__('#c4161c', 'rumi');
?>
   <p>
    <label for="<?php
        echo esc_attr($this->get_field_id('title'));
?>">
    <?php
        esc_attr_e('Title:', 'rumi');
?>
   </label> 
    
    <input 
        class="widefat" 
        id="<?php
        echo esc_attr($this->get_field_id('title'));
?>" 
        name="<?php
        echo esc_attr($this->get_field_name('title'));
?>" 
        type="text" 
        value="<?php
        echo esc_attr($title);
?>">
       
    </p>
    <?php
    }
    
    // save options
    public function update($new_instance, $old_instance)
    {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['rtf'] = (!empty($new_instance['rtf'])) ? strip_tags($new_instance['rtf']) : '';
        $instance['rhf'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['rhf']) : '';
        $instance['fcolor'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['fcolor']) : '';
        $instance['bgcolor'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['bgcolor']) : '';
        return $instance;
    }
}


/* * ******************************************************** */

class corona_bd_widget_world extends WP_Widget{
    // class constructor
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'corona_bd_widget_world',
            'description' => 'This Is free Plugin For Display Corona Case Result'
        );
        parent::__construct('corona_bd_widget_world', 'বিশ্বজুড়ে করোনাভাইরাস', $widget_ops);
    }
    
    // output the widget content on the front-end
    public function widget($args, $instance)
    {
         echo $args['before_widget'];
  $data = json_decode(Corona_bdData());
        
        ?>
 <div class="world-stats">
<div class="coronavirus-statistics">
<?php if (!empty($instance['title'])) {
            ?>
<h2><?php echo $instance['title'];?></h2>

<?php }?>

<div class="body body-bangladesh">
<h2>বাংলাদেশে</h2>
<div class="content">
<div class="text">আক্রান্ত</div>
<div class="number"><?php echo Corona_Bangla_Convert(number_format($data->cases));?></div>
</div>
<div class="content">
<div class="text">সুস্থ</div>
<div class="number"><?php echo Corona_Bangla_Convert(number_format($data->recovered));?></div>
</div>
<div class="content">
<div class="text">মৃত্যু</div>
<div class="number death"><?php echo Corona_Bangla_Convert(number_format($data->deaths));?></div>
</div>

</div>
<div class="body body-world">
<h2>বিশ্বে</h2>
<?php  $data = json_decode(Corona_worldData());?>
<div class="content">
<div class="text">আক্রান্ত</div>
<div class="number"><?php echo Corona_Bangla_Convert(number_format($data->cases));?></div>
</div>
<div class="content">
<div class="text">সুস্থ</div>
<div class="number"><?php echo Corona_Bangla_Convert(number_format($data->recovered));?></div>
</div>
<div class="content">
<div class="text">মৃত্যু</div>
<div class="number death"><?php echo Corona_Bangla_Convert(number_format($data->deaths));?></div>
</div>

</div>
</div>
</div>


       <?php
        echo $args['after_widget'];
    }
    
    // output the option form field in admin Widgets screen
    
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('বিশ্বজুড়ে করোনাভাইরাস', 'rumi');
         
?>
   <p>
    <label for="<?php
        echo esc_attr($this->get_field_id('title'));
?>">
    <?php
        esc_attr_e('Title:', 'rumi');
?>
   </label> 
    
    <input 
        class="widefat" 
        id="<?php
        echo esc_attr($this->get_field_id('title'));
?>" 
        name="<?php
        echo esc_attr($this->get_field_name('title'));
?>" 
        type="text" 
        value="<?php
        echo esc_attr($title);
?>">
       

    </p>
    <?php
    }
    
    // save options
    public function update($new_instance, $old_instance)
    {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        
        return $instance;
    }
}

// Short Code [corona_world_result]
function corona_world_function($atts)
{
  $data = json_decode(Corona_bdData());
  $wdata = json_decode(Corona_worldData());

$output = '<div class="world-stats"><div class="coronavirus-statistics">
<h2>বিশ্বজুড়ে করোনাভাইরাস<h2>
<div class="body body-bangladesh">
<h2>বাংলাদেশে</h2>
<div class="content">
<div class="text">আক্রান্ত</div>
<div class="number">'.Corona_Bangla_Convert(number_format($data->cases)).'</div>
</div>
<div class="content">
<div class="text">সুস্থ</div>
<div class="number">'.Corona_Bangla_Convert(number_format($data->recovered)).'</div>
</div>
<div class="content">
<div class="text">মৃত্যু</div>
<div class="number death">'.Corona_Bangla_Convert(number_format($data->deaths)).'</div>
</div>

</div>
<div class="body body-world">
<h2>বিশ্বে</h2>
<div class="content">
<div class="text">আক্রান্ত</div>
<div class="number">'.Corona_Bangla_Convert(number_format($wdata->cases)).'</div>
</div>
<div class="content">
<div class="text">সুস্থ</div>
<div class="number">'.Corona_Bangla_Convert(number_format($wdata->recovered)).'</div>
</div>
<div class="content">
<div class="text">মৃত্যু</div>
<div class="number death">'.Corona_Bangla_Convert(number_format($wdata->deaths)).'</div>
</div>

</div>
</div>
<div style="background: black; text-align: center;font-family: solaimanlipi"><a style="color: white;text-decoration: none;" href="https://coronacase.xyz/">তথ্য সূত্রঃ করোনা কেইস বাংলাদেশ</a></div>
</div>';
    
    return $output;
}
add_shortcode('corona_world_result', 'corona_world_function');

// Short Code [corona_bd_result]
function corona_bd_function($atts)
{
    $data = json_decode(Corona_bdData());
    $output = '<div class="corona-widget">
<div class="warp"><div class="corona-col clogo">
<div class="virus-logo">
<h2><small>বাংলাদেশে</small> <br> করোনাভাইরাস </h2>
</div>
</div>
</div>
 
<div class="lasttf">সর্বশেষ (গত ২৪ ঘন্টার রিপোর্ট)</div>
<div class="coronaTable">
<div class="coronaTableBody">
<div class="coronaTableRow">
<div class="coronaTableCell" style="font-size: 20px;background: #00A79D;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">আক্রান্ত</div>
<div class="coronaTableCell" style="font-size: 20px;background: #ED1C24;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">মৃত্যু</div>
<div class="coronaTableCell" style="font-size: 20px;background: #8DC63F;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">সুস্থ</div>
<div class="coronaTableCell" style="font-size: 20px;background: #27AAE1;color: #fff;max-width: 200px;margin: 0px auto;margin-bottom: 20px;text-align: center;">পরীক্ষা</div>
</div>

<div class="coronaTableRow">
<div class="coronaTableCell aff">'.Corona_Bangla_Convert(number_format($data->todayCases)).'</div>
<div class="coronaTableCell mmmm">'.Corona_Bangla_Convert(number_format($data->todayDeaths)).'</div>
<div class="coronaTableCell ss">'.Corona_Bangla_Convert(number_format($data->todayRecover)).'</div>
<div class="coronaTableCell tt">'.Corona_Bangla_Convert(number_format($data->todayTests)).'</div>
</div>
</div>

</div>
<div class="lasttf">সর্বমোট</div>
<div class="coronaTable">
<div class="coronaTableRow">
<div class="coronaTableCell aff">'.Corona_Bangla_Convert(number_format($data->cases)).'</div>
<div class="coronaTableCell mmmm">'.Corona_Bangla_Convert(number_format($data->deaths)).'</div>
<div class="coronaTableCell ss">'.Corona_Bangla_Convert(number_format($data->recovered)).'</div>
<div class="coronaTableCell tt">'.Corona_Bangla_Convert(number_format($data->tests)).'</div>
</div>
</div>
<div style="background: black; text-align: center;font-family: solaimanlipi"><a style="color: white;text-decoration: none;" href="https://coronacase.xyz/">তথ্য সূত্রঃ করোনা কেইস বাংলাদেশ</a></div>
</div>';
    
    return $output;
}
add_shortcode('corona_bd_result', 'corona_bd_function');
