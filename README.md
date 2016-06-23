#mwt
######Minecraft Web Tools
A basic set of tools for [Minecraft](https://minecraft.net) and the stuff having to do with it. Running at https://mwt.herokuapp.com.

###Tools
- *et*
  - hostname2ip
  - ip2hostname
  - pwgen
  - string2hash
- *mc*
  - name2uuid
  - query
  - skinview
  - uuid2name
- *pm*
  - downloadcount
  - plugininfo
  - userplugins

###Usage
You can deploy mwt locally by running the following:
```sh
$ git clone https://github.com/Gamecrafter/mwt
$ cd mwt
$ php -S localhost:<port>
```
The following extensions were loaded for the web server (but not all were used):
```
Array ( 
    [0] => Core 
    [1] => date 
    [2] => ereg 
    [3] => libxml 
    [4] => openssl 
    [5] => pcre 
    [6] => dom 
    [7] => filter 
    [8] => hash 
    [9] => SPL 
    [10] => PDO 
    [11] => readline 
    [12] => Reflection 
    [13] => session 
    [14] => standard 
    [15] => xml 
    [16] => mysqlnd 
    [17] => cli_server 
    [18] => bz2 
    [19] => curl 
    [20] => gd 
    [21] => json 
    [22] => SimpleXML 
    [23] => sockets 
    [24] => zip 
    [25] => zlib 
    [26] => mhash
    [27] => mbstring
)
```