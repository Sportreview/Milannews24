function VideoSportReview(url,autoplay,width,height,mute,repeat,videoid,poster){if(autoplay==="false"){autoplay=false;}else{autoplay=true;}if(repeat==="false"){repeat=false;}else{repeat=true;}if(mute==="false"){mute=false;}else{mute=true;}if(DebugCustom){console.log("ARTICLE autoplay"+autoplay);}if(DebugCustom){console.log("ARTICLE repeat"+repeat);}if(DebugCustom){console.log("ARTICLE mute"+mute);}var DebugCustom=true;var poster=poster;var url=url;var res=url.split("|");var counterlenght=res.length;if(counterlenght==1){if(DebugCustom){console.log("Single: "+url);}var video_playlists=[url];}else{var video_playlists=res;if(DebugCustom){console.log("Multiple: "+video_playlists);}}var bitrates={hls:''+video_playlists[0]+''};var prerollTag="https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/21624773413/Milannews24.com/Preroll&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=__referrer__&description_url=__domain__&correlator=__timestamp__";var waterfallArray=['https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/21624773413/Milannews24.com/Preroll_4W_Marketplace&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=__referrer__&description_url=__domain__&correlator=__timestamp__'];var settings={logo:'https://www.milannews24.com/wp-content/themes/Newspaper-child/images/logo-mil24-video.png',logoLoc:'https://www.milannews24.com/',pathToRmpFiles:'//cdn.sportreview.it/radiantmp/latest/',licenseKey:'dG54dHd4aXh6aEAxNTA5NDU3',bitrates:bitrates,muted:mute,delayToFade:3000,autoplay:autoplay,ads:true,adDisableCustomPlaybackForIOS10Plus:true,adTagUrl:prerollTag,adTagWaterfall:waterfallArray,adPauseOnClick:false,adTagReloadOnEnded:true,poster:poster,autoHeightMode:true,adCountDown:true,skinAccentColor:'fb090b',labels:{ads:{controlBarCustomMessage:'Messaggio promozionale'},hint:{sharing:'Condividi',quality:'Qualità',speed:'Velocità',captions:'Sottotitoli',audio:'Audio',cast:'Cast',playlist:'Playlist'},error:{customErrorMessage:'Il contenuto video non è al momento disponibile.',noSupportMessage:'Manca il supporto per la riproduzione dei video.',noSupportDownload:'Puoi scaricare il video qui.',noSupportInstallChrome:'E\' necessario aggiornare Google Chrome per visualizzare questo contenuto.'}}};var elementID='rmpPlayer-'+videoid;var rmp=new RadiantMP(elementID);var rmpContainer=document.getElementById(elementID);var videoEnded=false;var waterfallIndex=0;var playlistItem=0;var lastItem=false;console.log("Engine Video 2.1 by Riccardo Mel");for(var i=0;i<video_playlists.length;i++){if(DebugCustom){console.log("Video playlist item: "+video_playlists[i]);}}rmpContainer.addEventListener('adcontentresumerequested',function(){if(DebugCustom){console.log("resume request");}});rmpContainer.addEventListener('adcontentpauserequested',function(){if(DebugCustom){console.log("pause request");}});rmpContainer.addEventListener('adalladscompleted',function(){if(DebugCustom){console.log("adalladscompleted");}if(!repeat&&lastItem){console.log("Loop Disattivato: pausa");rmp.pause();}});rmpContainer.addEventListener('ended',function(){videoEnded=true;playlistItem++;if(DebugCustom){console.log(playlistItem);}if(typeof video_playlists[playlistItem]!=='undefined'){lastItem=false;rmp.setSrc(video_playlists[playlistItem]);if(DebugCustom){console.log("Play:"+video_playlists[playlistItem]);}}else{lastItem=true;playlistItem=0;rmp.setSrc(video_playlists[0]);if(DebugCustom){console.log("playdefault video");}}});rmpContainer.addEventListener('srcchanged',function(){if(DebugCustom){console.log("srcchanged");}});rmpContainer.addEventListener('aderror',function(){if(DebugCustom){console.log("aderror: ");}});rmpContainer.addEventListener('adloaded',function(){if(DebugCustom){console.log("adloaded");}});rmpContainer.addEventListener('pause',function(){if(DebugCustom){console.log("pause");}rmp.showPoster();});rmp.init(settings);}