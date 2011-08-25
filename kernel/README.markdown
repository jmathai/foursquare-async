Foursquare-async
=======================
#### A high performance PHP library for the Foursquare version 2 API

----------------------------------------

### An example usage

Included in the repository are unit tests inside the `tests` directory as well as an easy to run script names `simpleTest.php`. You can load `simpleTest.php` up in a browser and you should see it working.

    $foursquare = new EpiFoursquare($clientId, $clientSecret);
    // http://developer.foursquare.com/docs/checkins/add.html
    $checkin = $foursquare->post('/checkins/add', array(
        'venueId' => '35610', 'broadcast' => 'public'
      )
    );
    echo "You've checked in a total of {$checkin->response->checkins->count} times";


### Documentation

There's complete documentation available on Github at <https://github.com/jmathai/foursquare-async/wiki>..

### The authors

Get in touch with the authors if you have suggestions or questions.
<table>
  <tr>
    <td><img src="http://www.gravatar.com/avatar/e4d1f099d40e3b453be3355349b90457?s=60"></td><td valign="middle">Jaisen Mathai<br>jaisen-at-jmathai.com<br><a href="http://www.jaisenmathai.com">http://www.jaisenmathai.com</a></td>
  </tr>
</table>
