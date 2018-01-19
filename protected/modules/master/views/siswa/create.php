<?php
include 'breadcumbs.php';
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var markerIconAdd = '<?php echo Yii::app()->createUrl('img/marker.png'); ?>';
    var infoWindow = new google.maps.InfoWindow();
    var zoom = 13;

    function updateLatPosition(latLng) {
        $(document).ready(function() {
            $("#lat").val(latLng.lat());
        });
        //document.formLatLong.lat.value = latLng.lat();
    }
    function updateLngPosition(latLng) {
        $(document).ready(function() {
            $("#longi").val(latLng.lng());
        });

        //document.formLatLong.longi.value = latLng.lng();
    }

    function updateMarkerAddress(str) {
        document.getElementById('address').innerHTML = str;
    }

    function CreateMarker(geocode_result) {
        console.log(geocode_result);
        var alamat_lat_lng = new google.maps.LatLng(geocode_result.geometry.location.lat, geocode_result.geometry.location.lng);
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: zoom,
            center: alamat_lat_lng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
            position: alamat_lat_lng,
            title: 'Alamat Siswa',
            map: map,
            icon: markerIconAdd,
            draggable: true
        });


        // Update current position info.
        updateLatPosition(alamat_lat_lng);
        updateLngPosition(alamat_lat_lng);

        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
        });

        infoWindow.setContent(geocode_result.formatted_address);
        infoWindow.open(map, marker);

        google.maps.event.addListener(marker, 'drag', function() {

            updateLatPosition(marker.getPosition());
            updateLngPosition(marker.getPosition());
        });

    }



</script>

<style>
    #mapCanvas {
        width: 700px;
        height: 300px;
    }

</style>

<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Tambah Data Siswa</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Siswa</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/siswa/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" value="1" class="validate[required]"  name="jenis_kelamin"> Laki-Laki
                                </label>

                                <label class="radio inline">
                                    <input type="radio" value="2" class="validate[required]" name="jenis_kelamin"> Perempuan
                                </label>
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" class="span2 datepicker validate[required]" name="tgl_lahir" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama">Agama</label>
                            <div class="controls">
                                <select name="agama" class="chosen span5" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                    <?php
                                    foreach ($data_agama as $d):
                                        ?>
                                        <option value="<?php echo $d['id_agama'] ?>"><?php echo $d['nama_agama'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="propinsi">Propinsi</label>
                            <div class="controls">
                                <select name="propinsi" class="chosen span5" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                    <?php
                                    foreach ($data_propinsi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_propinsi'] ?>"><?php echo $d['nama_propinsi'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <div id="kota_loading"></div>
                        <div class="control-group">											
                            <label class="control-label" for="kota">Kota Lahir</label>
                            <div class="controls">
                                <select name="kota" class="chosen span5 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="nama_ortu">Nama Ortu</label>
                            <div class="controls">
                                <input type="text" class="span8" name="nama_ortu" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="pekerjaan_ortu">Pekerjaan Ortu</label>
                            <div class="controls">
                                <input type="text" class="span8" name="pekerjaan_ortu" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="kekhususan">Kekhususan</label>
                            <div class="controls">
                                <textarea name="kekhususan" style="resize: none;height:80px" class="validate[required] span6"></textarea>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat" id="alamat"  style="resize: none;height:80px" class="span6"></textarea>
                                <div class="alert" style="margin: 10px 0px">
                                    <i><strong>Sekedar Info</strong> Untuk mempermudah pencarian alamat dalam map gunakan format alamat lengkap(Tanpa singkatan) seperti contoh : <br/> "Jalan Margorejo 7a, Surabaya" atau "Pucang Anom Timur, Surabaya"</i>
                                </div>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat Map</label>
                            <div class="controls">
                                <span id="show_on_map" class="btn btn-success">Lihat Alamat Peta</span>
                                <input type="text" id="lat" name="lat" style="background-color:#b0b6bd;" readonly="true"/>
                                <input type="text" id="longi" name="longi" style="background-color:#b0b6bd;" readonly="true"/>
                                <div id="mapCanvas" style="display: none;margin: 20px 0px"></div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/siswa/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('table.datatable').dataTable({
            "lengthChange": true,
        });
        $('#show_on_map').click(function() {
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + $('#alamat').val(), function(data) {
                if (!$.isEmptyObject(data.results)) {
                    var geocode_result = data.results[0];
                    $('#mapCanvas').show();
                    CreateMarker(geocode_result);
                } else {
                    alert('Map tidak ditemukan, coba cari mulai dari nama daerah/kecamatan/kelurahan');
                }
            });
        });
    });
</script>