<?php $player_id = (isset($player_id)) ? $player_id : 'videoPlayer'; ?>
<link href="https://vjs.zencdn.net/8.2.0/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/8.2.0/video.min.js"></script>
<link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">
<script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>
<script src="<?= base_url('assets/js/videojs-watermark.js') ?>"></script>
<video id="<?= $player_id ?>" class="video-js vjs-default-skin" style="width:100%;">
    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
</video>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // The playback URL you need a signed URL for
        const playbackUrl = "<?= $playbackUrl ?>";
        const resolutions = <?= json_encode($resolutions) ?>;

        // Fetch the signed URL from the server
        fetch('<?= base_url("member/api/gumlet-video/get-signed-url") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    playbackUrl: playbackUrl,
                    resolutions: resolutions
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.signedUrls) {
                    // Initialize Video.js player with the signed URL
                    var player = videojs('<?= $player_id ?>');
                    player.preload('none');
                    player.controls(true);
                    player.autoplay(false);
                    player.aspectRatio('16:9');
                    player.playbackRates([0.5, 1, 1.5, 2]);
                    player.poster('<?= $thumbnail ?>');
                    player.controlBar.addChild('QualitySelector');

                    // Prepare sources array from signed URLs
                    const sources = Object.keys(data.signedUrls.resolutions).map(resolution => {
                        return {
                            src: data.signedUrls.resolutions[resolution],
                            type: 'application/x-mpegURL',
                            label: `${resolution}P`,
                            selected: resolution === '480' // Default selected resolution
                        };
                    });

                    /*player.src({
                        src: data.signedUrl,
                        type: 'application/x-mpegURL'
                    });*/
                    player.src(sources);

                    player.dynamicWatermark({
                        watermarkText: "Menonton sebagai <?= mask_email($sessionData['email']) ?>",
                        changeDuration: 3000,
                        cssText: "display: inline-block; color: red; background-color: transparent; font-size: 0.8rem; z-index: 9999; position: absolute; @media only screen and (max-width: 992px){font-size: 0.4rem;}",
                    });

                    player.on('error', function() {
                        console.error('Video.js error:', player.error());
                    });
                } else {
                    console.error("Failed to get signed URL:", data);
                }
            })
            .catch(error => console.error("Error fetching signed URL:", error));
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>