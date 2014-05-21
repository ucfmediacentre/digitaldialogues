using System;
using System.Net;
using System.Windows;
using System.Windows.Browser;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Ink;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Shapes;
using Microsoft.SilverlightMediaFramework.Core;
using Microsoft.SilverlightMediaFramework.Utilities.Extensions;
using Microsoft.SilverlightMediaFramework.Plugins.Primitives;
using Microsoft.Web.Media.SmoothStreaming;
using Microsoft.SilverlightMediaFramework.Plugins.SmoothStreaming;
using Microsoft.SilverlightMediaFramework.Core.Media;
using System.Collections.ObjectModel;

namespace LiveDvrSmoothStreaming
{
    public class DvrSMFPlayer : SMFPlayer
    {
        SmoothStreamingMediaElement ssme;
        private String newStream;

        public void LogIt(object obj)
        {
/*
 if (HtmlPage.IsEnabled)
            {
                HtmlWindow window = HtmlPage.Window;
                var isConsoleAvailable = (bool)window.Eval("typeof(console) != 'undefined' && typeof(console.log) != 'undefined'");
                if (isConsoleAvailable)
                {
                    var console = (window.Eval("console.log") as ScriptObject);
                    if (console != null)
                    {
                        console.InvokeSelf(obj);
                    }
                }
            }
 * */
        }


        protected override void OnMediaPluginLoaded()
        {
            base.OnMediaPluginLoaded();

            ssme = base.ActiveMediaPlugin.VisualElement as SmoothStreamingMediaElement;

            if (ssme != null)
            {
                ssme.AutoPlay = false;
                ssme.MediaFailed += new EventHandler<ExceptionRoutedEventArgs>(SmoothPlayer_MediaFailed);
                ssme.SmoothStreamingErrorOccurred += new EventHandler<SmoothStreamingErrorEventArgs>(SmoothPlayer_SmoothStreamingErrorOccurred);
                ssme.ClipError += new EventHandler<ClipEventArgs>(SmoothPlayer_ClipError);
            }

        }
        protected override void OnMediaPluginLoadFailed()
        {
            reportError("Media Plugin Did Not Load");
        }

        public void reportError(String errorMessage)
        {
            LogIt(errorMessage);
            MessageBox.Show(errorMessage);
        }

        void SmoothPlayer_MediaFailed(object sender, ExceptionRoutedEventArgs e)
        {
            if (e.ErrorException.Message.StartsWith("3222"))
            {
                // this will be triggered after the "failed to download" message
                //reportError("Media Error: " + e.ErrorException.Message);
            }
            else
            {
                reportError("Media Error: " + e.ErrorException.Message);
            }
        }

        void SmoothPlayer_SmoothStreamingErrorOccurred(object sender, SmoothStreamingErrorEventArgs e)
        {
            if(e.ErrorMessage!=null && e.ErrorMessage.StartsWith("Failed to download"))
            {
                reportError("Source stream or file could not be found or access was denied.");
            } 
            else
            {
                reportError("Streaming Error: " + e.ErrorMessage);
            }
        }

        void SmoothPlayer_ClipError(object sender, ClipEventArgs e)
        {
            reportError("Clip Error: " + e.Context.CurrentClipState.ToString());
        }

        [ScriptableMember()]
        public void playerStop()
        {
            if (ssme != null && ssme.CurrentState == SmoothStreamingMediaElementState.Playing)
            {
                ssme.Stop();
            }
        }
        [ScriptableMember()]
        public void playerStart()
        {
            try
            {
                var playlist = new ObservableCollection<PlaylistItem>();
                var playlistItem = new PlaylistItem
                {
                    MediaSource = new Uri(newStream)
                };
                playlistItem.DeliveryMethod = DeliveryMethods.AdaptiveStreaming;
                playlist.Add(playlistItem);
                Playlist = playlist;
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
        }
        [ScriptableMember()]
        public void setStream(String stream)
        {
            newStream = stream;
            //document.getElementById("smoothVideoPlayer").Content.wowza.setStream("http://localhost:1935/dvr/myStream/Manifest?dvr");
        }

    }

}
