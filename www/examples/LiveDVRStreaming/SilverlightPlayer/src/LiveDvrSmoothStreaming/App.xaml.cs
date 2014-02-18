using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Shapes;
using Microsoft.SilverlightMediaFramework.Core;
using Microsoft.SilverlightMediaFramework.Utilities.Extensions;
using Microsoft.SilverlightMediaFramework.Plugins.Primitives;
using System.Windows.Browser;

namespace LiveDvrSmoothStreaming
{
    public partial class App : Application
    {
        DvrSMFPlayer player;
        public App()
        {
            this.Startup += this.Application_Startup;
            this.Exit += this.Application_Exit;
            this.UnhandledException += this.Application_UnhandledException;

            InitializeComponent();
        }

        private void Application_Startup(object sender, StartupEventArgs e)
        {
            player = new DvrSMFPlayer();

            player.LogIt("player created");

            // Assign Style found in xaml, which turns off slow motion, fast forward, and rewind
            player.Style  = (Style)Resources["SMFPlayerStyle1"];

            // Also remove playlist and captions from UI
            player.PlaylistVisibility = FeatureVisibility.Disabled;
            player.CaptionsVisibility = FeatureVisibility.Disabled;

            // Pass player the initParams from html
            if (e.InitParams != null)
            {
                if (!e.InitParams.ContainsKeyIgnoreCase(SupportedInitParams.DeliveryMethod))
                {
                    e.InitParams.Add(SupportedInitParams.DeliveryMethod, DeliveryMethods.AdaptiveStreaming.ToString());
                }

                player.LoadInitParams(e.InitParams);
            }

            this.RootVisual = player;
            HtmlPage.RegisterScriptableObject("wowza", player);
        }


        private void Application_Exit(object sender, EventArgs e)
        {

        }
        private void Application_UnhandledException(object sender, ApplicationUnhandledExceptionEventArgs e)
        {

            // If the app is running outside of the debugger then report the exception using
            // the browser's exception mechanism. On IE this will display it a yellow alert 
            // icon in the status bar and Firefox will display a script error.
            if (!System.Diagnostics.Debugger.IsAttached)
            {

                // NOTE: This will allow the application to continue running after an exception has been thrown
                // but not handled. 
                // For production applications this error handling should be replaced with something that will 
                // report the error to the website and stop the application.
                e.Handled = true;
                Deployment.Current.Dispatcher.BeginInvoke(delegate { ReportErrorToDOM(e); });
            }
        }
        private void ReportErrorToDOM(ApplicationUnhandledExceptionEventArgs e)
        {
            try
            {
                string errorMsg = e.ExceptionObject.Message + e.ExceptionObject.StackTrace;
                errorMsg = errorMsg.Replace('"', '\'').Replace("\r\n", @"\n");

                System.Windows.Browser.HtmlPage.Window.Eval("throw new Error(\"Unhandled Error in Silverlight Application " + errorMsg + "\");");
            }
            catch (Exception)
            {
            }
        }
    }
}
