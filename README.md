**Chinook_abridged Database**

**Artist**

_Get all Artists_

- **URL**

  <http://localhost/chin-api/artist>

- **Method:**

  `GET`

_Search for Artist by name, page and Id_

- **URL**
  <http://localhost/chin-api/artist/?id=1>
  <http://localhost/chin-api/artist/?name=A&p=1>

- **Method:**

  `GET`

_Create An Artist_

- **URL**
  <http://localhost/chin-api/artist/>

- **Method:**

  `POST`

- **x-www-form-urlencoded:**
    <table>
    <tr>
    <td><strong>key</strong></td>
    <td><strong>value</strong></td>
    </tr>
    <tr>
    <td>name</td>
    <td>Abdul</td>
    </tr>
    </table>

_Update An Artist_

- **URL**
  <http://localhost/chin-api/artist/>

- **Method:**

`POST`

- **x-www-form-urlencoded:**
    <table>
    <tr>
    <td><strong>key</strong></td>
    <td><strong>value</strong></td>
    </tr>
    <tr>
    <td>artistId</td>
    <td>1</td>
    </tr>
    <tr>
    <td>name</td>
    <td>James</td>
    </tr>
    </table>

_Delete An Artist_

- **URL**
  <http://localhost/chin-api/artist/?id=1>

- **Method:**

  `DELETE`

**Album**

_Get all Albums_

- **URL**

  <http://localhost/chin-api/album>

- **Method:**

  `GET`

_Search for Album by name, page and Id_

- **URL**
  <http://localhost/chin-api/album/?name=A&p=1>
  <http://localhost/chin-api/album/?id=1>

- **Method:**

  `GET`

_Create An Album_

- **URL**
  <http://localhost/chin-api/album/>

- **Method:**

  `POST`

- **x-www-form-urlencoded:**
    <table>
    <tr>
    <td><strong>key</strong></td>
    <td><strong>value</strong></td>
    </tr>
    <tr>
    <td>title</td>
    <td>My Album</td>
    </tr>
    <tr>
    <td>artistId</td>
    <td>1</td>
    </tr>
    </table>

_Update an Album_

- **URL**
  <http://localhost/chin-api/album>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
    <table>
    <tr>
    <td><strong>key</strong></td>
    <td><strong>value</strong></td>
    </tr>
    <tr>
    <td>title</td>
    <td>My Album 2</td>
    </tr>
    <tr>
    <td>albumId</td>
    <td>1</td>
    </tr>
    </table>

_Delete an Album_

- **URL**
  <http://localhost/chin-api/album?id=1>

- **Method**
  `DELETE`

**Track**

_Get all Tracks_

- **URL**
  <http://localhost/chin-api/track>

- **Method**
  `GET`

_Search for Track by name, page and Id_

- **URL**
  <http://localhost/chin-api/track/?id=1>
  <http://localhost/chin-api/track/?name=A&p=1>

- **Method**
  `GET`

_Create Track_

- **URL**
  <http://localhost/chin-api/track>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
  <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>name</td>
  <td>My Track song</td>
  </tr>
  <tr>
  <td>albumId</td>
  <td>1</td>
  </tr>
   <tr>
  <td>mediaType</td>
  <td>1</td>
  </tr>
  <tr>
  <td>genreId</td>
  <td>2</td>
  </tr>
  <tr>
  <td>composer</td>
  <td>Mozart</td>
  </tr>
  <tr>
  <td>milliseconds</td>
  <td>300000</td>
  </tr>
  <tr>
  <td>bytes</td>
  <td>20000</td>
  </tr>
  <tr>
  <td>unitPrice</td>
  <td>1.00</td>
  </tr>
  </table>

_Update Track_

- **URL**
  <http://localhost/chin-api/track>

- **Method**
  `POST`

- **x-www-form-urlencoded:**

    <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>name</td>
  <td>My Track song 2</td>
  </tr>
   <tr>
  <td>mediaType</td>
  <td>2</td>
  </tr>
  <tr>
  <td>genreId</td>
  <td>3</td>
  </tr>
  <tr>
  <td>composer</td>
  <td>Beethoven</td>
  </tr>
  <tr>
  <td>milliseconds</td>
  <td>500000</td>
  </tr>
  <tr>
  <td>bytes</td>
  <td>100000</td>
  </tr>
  <tr>
  <td>unitPrice</td>
  <td>1.50</td>
  </tr>
  <tr>
  <td>id</td>
  <td>1</td>
  </tr>
  </table>

_Delete Track_

- **URL**
  <http://localhost/chin-api/track?id=1>

- **Method**
  `DELETE`

**Customer**

_Get all Customers_

- **URL**
  <http://localhost/chin-api/customer>

- **Method**
  `GET`

_Search for customer by Id_

- **URL**
  <http://localhost/chin-api/customer/?id=1>

- **Method**
  `GET`

_Create a Customer_

- **URL**
  <http://localhost/chin-api/customer>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
  <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>firstName</td>
  <td>Harry</td>
  </tr>
  <tr>
  <td>lastName</td>
  <td>Potter</td>
  </tr>
   <tr>
  <td>company</td>
  <td>Hogwarts Co.</td>
  </tr>
  <tr>
  <td>address</td>
  <td>Baker street</td>
  </tr>
  <tr>
  <td>city</td>
  <td>London</td>
  </tr>
  <tr>
  <td>state</td>
  <td>London</td>
  </tr>
  <tr>
  <td>country</td>
  <td>England</td>
  </tr>
  <tr>
  <td>postalCode</td>
  <td>4700</td>
  </tr>
  <tr>
  <td>phone</td>
  <td>12345678</td>
  </tr>
  <tr>
  <td>fax</td>
  <td>123456</td>
  </tr>
  <tr>
  <td>email</td>
  <td>a@a.com</td>
  </tr>
  <tr>
  <td>password</td>
  <td>my secret</td>
  </tr>
  <tr>
  <td>password-repeat</td>
  <td>my secret</td>
  </tr>
  </table>

_Update Customer information_

- **URL**
  <http://localhost/chin-api/customer>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
  <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>customerId</td>
  <td>1</td>
  </tr>
  <tr>
  <td>firstName</td>
  <td>Ron</td>
  </tr>
   <tr>
  <td>lastName</td>
  <td>Weasley</td>
  </tr>
  <tr>
  <td>company</td>
  <td>Spacetoon</td>
  </tr>
  <tr>
  <td>address</td>
  <td>Wizard Place</td>
  </tr>
  <tr>
  <td>city</td>
  <td>Copenhagen</td>
  </tr>
  <tr>
  <td>state</td>
  <td>Zealand</td>
  </tr>
  <tr>
  <td>country</td>
  <td>Denmark</td>
  </tr>
  <tr>
  <td>postalCode</td>
  <td>1054</td>
  </tr>
  <tr>
  <td>phone</td>
  <td>87654321</td>
  </tr>
  <tr>
  <td>fax</td>
  <td>654321</td>
  </tr>
  <tr>
  <td>email</td>
  <td>b@b.com</td>
  </tr>
  </table>

_Update Customer password_

- **URL**
  <http://localhost/chin-api/customer>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
    <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>password</td>
  <td>new password</td>
  </tr>
  <tr>
  <td>password-repeat</td>
  <td>new password</td>
  </tr>
  <tr>
  <td>customerId</td>
  <td>1</td>
  </tr>
    </table>

_Delete a customer_

- **URL**
  <http://localhost/chin-api/customer/?id=1>

- **Method**
  `DELETE`

**MediaType**

_Get all Mediatypes_

- **URL**
  <http://localhost/chin-api/mediatype>

- **Method**
  `GET`

**Genre**

_Get all Genres_

- **URL**
  <http://localhost/chin-api/genre>

- **Method**
  `GET`

**Invoice and InvoiceLines**

_Create Invoice and InvoiceLines_

- **URL**
  <http://localhost/chin-api/invoice>

- **Method**
  `POST`

- **x-www-form-urlencoded:**
  <table>
  <tr>
  <td><strong>key</strong></td>
  <td><strong>value</strong></td>
  </tr>
  <tr>
  <td>customerId</td>
  <td>1</td>
  </tr>
  <tr>
  <td>billingAddress</td>
  <td>Primulavej 3</td>
  </tr>
   <tr>
  <td>billingCity</td>
  <td>Næstved</td>
  </tr>
  <tr>
  <td>billingState</td>
  <td>Zealand</td>
  </tr>
  <tr>
  <td>billingCountry</td>
  <td>Denmark</td>
  </tr>
  <tr>
  <td>billingPostalCode</td>
  <td>4700</td>
  </tr>
  <tr>
  <td>total</td>
  <td>100</td>
  </tr>
  <tr>
  <td>invoiceLines[0][quantity]</td>
  <td>1</td>
  </tr>
  <tr>
  <td>invoiceLines[0][trackId]</td>
  <td>2</td>
  </tr>
  <tr>
  <td>invoiceLines[0][unitPrice]</td>
  <td>100</td>
  </tr>
  </table>
