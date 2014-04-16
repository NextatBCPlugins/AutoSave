/*!
 * AutoSave: baserCMS Plugin
 * Copyright 2014 Nextat Inc.<http://nextat,co,jp>
 * 
 * Released under the MIT license
 * http://opensource.org/licenses/mit-license.php
 */
var Nextat;
(function (Nextat) {
    (function (BcPluginAutoSave) {
        /**
         * @class
         * @name FormData
         * @memberOf Nextat.BcpluginAutoSave
         */
        var FormData = (function () {
            /**
             * コンストラクタ
             * 
             * @constructor
             * @param {Object} config 設定
             */
            function FormData(config) {
                this.id = config.id;
                this.interval = config.interval * 1000 || 30000;
                this.form = document.getElementById(this.id);
                this.logId = 'AutoSaveLog';
                this.logPrefix = '【自動保存プラグイン】';
                this.prefix = config.prefix;
                this.key = this.prefix + ':' + location.host + location.pathname;
                this.storage = config.storage;
            }
            /**
             * ログを書き出す処理
             * @param {String} message
             */
            FormData.prototype.log = function(message) {
                this.$logArea.html(this.logPrefix + message + ' @ ' + formatDate(new Date()));
            };
            
            FormData.prototype.initLogArea = function() {
                var html = '<div id="' + this.logId + '" style="color:#666; text-align:right;">' + this.logPrefix + '</div>';
                this.$logArea = $(html);
                 $(this.form).before(this.$logArea);
            };
            /**
             * 初期化処理
             */
            FormData.prototype.init = function () {
                this.initLogArea();
                if(this.isRestorable()) {
                    if(confirm('自動保存データをがあります。復元しますか？')) {
                        this.restore();
                    }
                }
                this.startSaving();
                
                var _this = this;
                jQuery(this.form).on('submit', function() {
                    _this.stopSaving();
                    _this.remove();
                });
            };
            
            /**
             * フォームのデータを保存
             */
            FormData.prototype.save = function () {
                this.updateData();
                this.storage.set(this.key, this.data);
                this.log('データを保存しました');
            };
            
            /**
             * 保存データの削除
             */
            FormData.prototype.remove = function () {
                this.storage.remove(this.key);
                this.log('保存データを削除しました');
            };
            
            /**
             * ストレージに対応するキーのデータが保存されているかチェック
             * 
             * @returns {Boolean}
             */
            FormData.prototype.isRestorable = function(){
                var value = this.storage.get(this.key);
                if(!value || value === 'undefined') {
                    return false;
                }
                
                return true;
            };
            
            /**
             * ストレージに保存されているデータをフォーム内に復元
             * @returns {Boolean}
             */
            FormData.prototype.restore = function(){
                var value = this.storage.get(this.key);
                if(! value || value === 'undefined') {
                    return false;
                }
                
                this.data = value;
                
                if(!this.data) {
                    return false;
                }
                this.updateElements();
                this.log('保存データを復元しました');
                return true;
            };
            
            /**
             * CKEDITORで編集中の内容をデータに反映
             */
            FormData.prototype.updateData = function() {
                if(typeof CKEDITOR !== 'undefined') {
                    for ( key in CKEDITOR.instances ) {
                        CKEDITOR.instances[key].updateElement();
                    }
                }
                
                //フォームからデータを取得
                this.data = jQuery(this.form).serializeArray();
            };
            
            /**
             * オブジェクトのデータでフォームを更新
             */
            FormData.prototype.updateElements = function() {
                var name = '';
                var value = '';
                var $elm = {};
                for(var i = 0, size = this.data.length; i < size; i++) {
                    name = this.data[i].name;
                    value = this.data[i].value;
                    if(!value || name === '_method' || name.match(/^data\[_Token\]/)) {
                        continue;
                    }
                    
                    $elm = jQuery('#' + this.id + " [name='" + name + "']").val(value);
                }
                this.updateCKEditor();
            };
            
            /**
             * CKEditorにフォームの内容を反映
             */
            FormData.prototype.updateCKEditor  = function() {
                var editor = {};
                if(typeof CKEDITOR !== 'undefined') {
                    for ( key in CKEDITOR.instances ) {
                        editor = CKEDITOR.instances[key];
                        editor.setData(editor.element.getValue());
                    }
                }
            };
            
            /**
             * 定期自動保存処理を開始
             */
            FormData.prototype.startSaving = function() {
                var _this = this;
                this.timeToken = setInterval(function () {
                    _this.save();
                }, this.interval);
            };
            
            /**
             * 定期自動保存処理を停止
             */
            FormData.prototype.stopSaving = function () {
                if(typeof this.timeToken === 'number') {
                    clearInterval(this.timeToken);
                }
                this.timeToken = null;
            };
            return FormData;
        })();
        BcPluginAutoSave.FormData = FormData;
        
        /**
         * 日時をフォーマットする
         * 
         * @param {Date} date
         * @returns {String}
         */
        var formatDate = function(date) {
            var y = date.getFullYear();
            var m = ('0' + (date.getMonth() + 1)).slice(-2) ;
            var d = ('0' + date.getDate()).slice(-2);
            var h = ('0' + date.getHours()).slice(-2);
            var i = ('0' + date.getMinutes()).slice(-2);
            var s = ('0' + date.getSeconds()).slice(-2);
            
            var dateFormatted = y + '/' + m + '/' + d + ' ' + h + ':' + i + ':' + s;
            return dateFormatted;
        };
        
    })(Nextat.BcPluginAutoSave || (Nextat.BcPluginAutoSave = {}));
    var BcPluginAutoSave = Nextat.BcPluginAutoSave;
})(Nextat || (Nextat = {}));