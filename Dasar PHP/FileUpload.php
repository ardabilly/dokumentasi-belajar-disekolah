<html>
    <head>
        <title>File Upload</title>
    </head>
    <body>
        <?php
            $s_Folder="rpl/";
            $s_FileData="";
            $byte_Data="";
            $s_ErrorMessage="";
            $b_Validation=true;
            
            if(isset($_POST["Submit"]))
            {
                if(is_uploaded_file($_FILES["File_Data"]["tmp_name"]))
                {
                    $d_Size=$_FILES["File_Data"]["tmp_name"];
                    $d_Size=doubleval($d_Size);
                    if($d_Size >1024*1024*40)
                    {
                        $s_ErrorMessage="Maaf File Size Tidak Boleh Lebih Dari 40MB";
                        
                        $b_Validation=false;
                    }
                    if($d_Size <1024*1024*40)
                    {
                        $s_ErrorMessage="Yeah File Berhasil Dikirim";
                        
                        $b_Validation=false;
                    }
                }
                if(!is_uploaded_file($_FILES["File_Data"]["tmp_name"]))
                {
                    $s_ErrorMessage="File tidak ada";
                    
                    $b_Validation=false;
                
                }
                
                if(is_uploaded_file($_FILES["File_Data"]["tmp_name"]))
                {
                    $s_FileData=$s_Folder.$_FILES["File_Data"]["name"];
                    $byte_Data=$_FILES["File_Data"]["tmp_name"];
                    $MoveResult=  move_uploaded_file($byte_Data,$s_FileData);
                    
                }
            }
        ?>
        <?=$s_ErrorMessage?>
        <Form action="" method="Post" enctype="multipart/form-data">
            <input type="File" name="File_Data"/>
            <input type="Submit" value="Submit" name="Submit"/>
        </form>
        <h1 style="margin-left:15%;">List</h1>
        <hr width="35.7%" style="margin-left: 0.3%;">
        <table>
            <tr>
                <th valign="top">
                    <img src="/icons/blank.gif" alt="[ICO]">
                </th>
                <th>
                    <a href="?C=N;O=D">Name</a>
                </th>
                <th>
                    <a href="?C=M;O=A"> Last Modified </a>
                </th>
                <th>
                    <a href="?C=S;O=A"> Description </a>
                </th>
            </tr>
            <tr>
                <th colspan="5">
                    <hr>
                </th>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/back.gif">
                </td>
                <td>
                    <a href="#"> Etc </a>
                </td>
                <td>&nbsp;</td>
                <td align="right"> - </td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="20160802_130914.jpg">20160802_130914.jpg</a>
                </td>
                <td align="right">2016-10-12 09:51  </td>
                <td align="right">1.4M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]"></td>
                <td>
                    <a href="20160802_131027.jpg">20160802_131027.jpg</a> 
                </td>
                <td align="right">2016-10-12 09:51  </td>
                <td align="right">1.6M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="20160802_131039.jpg">20160802_131039.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.7M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="20160802_131121.jpg">20160802_131121.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.7M</td><td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="20160802_131148.jpg">20160802_131148.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.7M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="20160803_105359.jpg">20160803_105359.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">493K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]"></td>
                <td>
                    <a href="20160803_110929.jpg">20160803_110929.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.5M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="ALHABIB%20MUHAMMAD%20BIN%20TAUFIQ.jpg">ALHABIB MUHAMMAD BIN..&gt;</a>
                </td>
                <td align="right">2016-10-12 09:50  </td>
                <td align="right">7.2K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/text.gif" alt="[TXT]"></td><td><a href="Aritmatika.PHP">Aritmatika.PHP</a>
                </td>
                <td align="right">2016-10-04 09:19  </td>
                <td align="right">609 </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/text.gif" alt="[TXT]">
                </td>
                <td>
                    <a href="Boolean.PHP">Boolean.PHP</a>
                </td>
                <td align="right">2016-10-04 09:38  </td>
                <td align="right">502 </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/text.gif" alt="[TXT]">
                </td>
                <td>
                    <a href="FormGet.php">FormGet.php</a>
                </td>
                <td align="right">2016-10-11 09:13  </td>
                <td align="right">3.1K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/text.gif" alt="[TXT]">
                </td>
                <td>
                    <a href="FormPost.php">FormPost.php</a>
                </td>
                <td align="right">2016-10-10 14:11  </td>
                <td align="right">1.3K</td>
                <td>&nbsp;</td></tr>
            <tr>
                <td valign="top">
                    <img src="/icons/text.gif" alt="[TXT]">
                </td>
                <td>
                    <a href="FormTestPost.php">FormTestPost.php</a>
                </td>
                <td align="right">2016-10-12 14:02  </td>
                <td align="right">9.0K</td>
                <td>&nbsp;</td>
            </tr>    
            <tr>
                <td valign="top"><img src="/icons/text.gif" alt="[TXT]"></td>
                <td>
                    <a href="Hello.php">Hello.php</a>
                </td>
                <td align="right">2016-10-04 08:39  </td>
                <td align="right">645 </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top"><img src="/icons/text.gif" alt="[TXT]"></td>
                <td>
                    <a href="HotPink.PHP">HotPink.PHP</a>
                </td>
                <td align="right">2016-10-04 08:56  </td>
                <td align="right">358 </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="IMG_0053.JPG">IMG_0053.JPG</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.9M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="IMG_0062.JPG">IMG_0062.JPG</a>
                </td>
                <td align="right">2016-10-12 09:50  </td>
                <td align="right">1.9M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="IMG_0063.JPG">IMG_0063.JPG</a>
                </td>
                <td align="right">2016-10-12 09:39  </td>
                <td align="right">1.6M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top"><img src="/icons/image2.gif" alt="[IMG]"></td>
                <td>
                    <a href="IMG_0108.JPG">IMG_0108.JPG</a>
                </td>
                <td align="right">2016-10-12 09:39  </td>
                <td align="right">2.0M</td>
                <td>&nbsp;</td></tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="IMG_0120.JPG">IMG_0120.JPG</a>
                </td>
                <td align="right">2016-10-12 09:40  </td>
                <td align="right">1.7M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="Iam.jpg">Iam.jpg</a>
                </td>
                <td align="right">2016-10-12 09:43  </td>
                <td align="right">618K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="Koala.jpg">Koala.jpg</a>
                </td>
                <td align="right">2016-10-12 09:10  </td>
                <td align="right">763K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top"><img src="/icons/text.gif" alt="[TXT]"></td>
                <td>
                    <a href="Looping.PHP">Looping.PHP</a>
                </td>
                <td align="right">2016-10-10 10:53  </td>
                <td align="right">612 </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top"><img src="/icons/text.gif" alt="[TXT]"></td>
                <td>
                    <a href="Switch%20Case.PHP">Switch Case.PHP</a>
                </td>
                <td align="right">2016-10-05 09:42  </td>
                <td align="right">1.8K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top"><img src="/icons/image2.gif" alt="[IMG]"></td>
                <td>
                    <a href="Tulips.jpg">Tulips.jpg</a>
                </td>
                <td align="right">2016-10-12 08:35  </td>
                <td align="right">606K</td><td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="coffe.jpg">coffe.jpg</a>
                </td>
                <td align="right">2016-10-12 09:43  </td>
                <td align="right"> 54K</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/folder.gif" alt="[DIR]">
                </td>
                <td>
                    <a href="icons/">icons/</a>
                </td>
                <td align="right">2016-10-14 10:45  </td>
                <td align="right">  - </td>
                <td>&nbsp;</td></tr>
            <tr>
                <td valign="top">
                    <img src="/icons/image2.gif" alt="[IMG]">
                </td>
                <td>
                    <a href="me.jpg">me.jpg</a>
                </td>
                <td align="right">2016-10-12 09:52  </td>
                <td align="right">1.4M</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/folder.gif" alt="[DIR]">
                </td>
                <td>
                    <a href="nbproject/">nbproject/</a>
                </td>
                <td align="right">2016-10-03 11:32  </td>
                <td align="right">  - </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">
                    <img src="/icons/folder.gif" alt="[DIR]">
                </td>
                <td>
                    <a href="qwerty/">qwerty/</a>
                </td>
                <td align="right">2016-10-14 09:08  </td>
                <td align="right">  - </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th colspan="5"><hr></th>
            </tr>
  </table>
        <span>Lorem ipsum dolor sit amet.
            Rekayasa Perangkat Lunak </span>
    </body>
</html>