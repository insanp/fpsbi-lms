<?php $player_id = (isset($player_id)) ? $player_id : 'videoPlayer'; ?>
<link href="https://vjs.zencdn.net/8.2.0/video-js.css" rel="stylesheet" />
<style>
    .video-js,
    .vjs-tech,
    .vjs-poster,
    .vjs-poster img {
        background-color: transparent;
        border-radius: 20px;
    }

    .video-js .vjs-control-bar {
        background-color: transparent;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
</style>
<script src="https://vjs.zencdn.net/8.2.0/video.min.js"></script>
<script src="https://www.unpkg.com/videojs-hls-quality-selector@2.0.0/dist/videojs-hls-quality-selector.min.js"></script>
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

                    // Add debug listener for play event
                    player.on('play', function() {

                    });

                    player.on('ready', function() {
                        console.log(player);
                        var settings = this.textTrackSettings;
                        settings.setValues({
                            "fontPercent": 0.5
                        });
                        settings.updateDisplay();
                    });

                    // Prepare sources array from signed URLs
                    const sources = Object.keys(data.signedUrls.resolutions).map(resolution => {
                        return {
                            src: data.signedUrls.resolutions[resolution],
                            type: 'application/x-mpegURL',
                            label: `${resolution}P`,
                            selected: resolution === '480' // Default selected resolution
                        };
                    });

                    player.src({
                        src: data.signedUrls.main,
                        type: 'application/x-mpegURL'
                    });

                    // Set default caption to Indonesian if available after metadata loads
                    player.on('loadedmetadata', function() {
                        var tracks = player.textTracks();
                        for (var i = 0; i < tracks.length; i++) {
                            if (tracks[i].label.toLowerCase() === 'indonesian') {
                                tracks[i].mode = 'showing';
                            } else {
                                tracks[i].mode = 'disabled';
                            }
                        }
                    });

                    // Initialize manual resolution selection via videojs-hls-quality-selector
                    player.ready(function() {
                        player.hlsQualitySelector();
                    });

                    // Remove dynamic watermark and add a static watermark element
                    player.ready(function() {
                        // Inject CSS animation for fade effect
                        var style = document.createElement('style');
                        style.innerHTML = `
                            @keyframes watermarkAnim {
                                0% { opacity: 0; }
                                20% { opacity: 1; }
                                80% { opacity: 1; }
                                100% { opacity: 0; }
                            }
                        `;
                        document.head.appendChild(style);

                        var watermarkDiv = document.createElement('div');
                        watermarkDiv.innerText = "Watermark Protection:\n<?= mask_email($sessionData['email']) ?>";
                        watermarkDiv.style.position = 'absolute';
                        // Initial position centered
                        watermarkDiv.style.left = '50%';
                        watermarkDiv.style.top = '50%';
                        watermarkDiv.style.transform = 'translate(-50%, -50%)';
                        // Dynamically set initial font size based on player's container width
                        var container = player.el();
                        watermarkDiv.style.fontSize = (container.clientWidth * 0.02) + 'px';
                        watermarkDiv.style.fontWeight = '900';
                        watermarkDiv.style.textAlign = 'center';
                        watermarkDiv.style.color = 'rgba(255, 0, 0, 0.3)';
                        watermarkDiv.style.textShadow = '0 0 10px rgba(0, 0, 0, 0.3)';
                        // Add text border for contrast
                        //watermarkDiv.style.webkitTextStroke = '1px black';
                        watermarkDiv.style.pointerEvents = 'none';
                        // Apply opacity animation
                        watermarkDiv.style.animation = "watermarkAnim 15s infinite";

                        // On each animation iteration, update position and font size
                        watermarkDiv.addEventListener('animationiteration', function() {
                            // set left and top to random values between 20-80% and 10-90% respectively
                            var randomLeft = Math.random() * 60 + 20;
                            var randomTop = Math.random() * 80 + 10;
                            watermarkDiv.style.left = randomLeft + '%';
                            watermarkDiv.style.top = randomTop + '%';
                            // Update fontSize based on current container width
                            watermarkDiv.style.fontSize = (container.clientWidth * 0.02) + 'px';
                        });

                        // Append watermark to the player's container
                        player.el().appendChild(watermarkDiv);

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