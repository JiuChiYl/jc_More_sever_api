/** 
 *  You must introduce the jQuery framework !
 */
/**
 * 描述
 * @date 2023-07-27
 * @param {any} dict -表示一个字典文件（json）
 * @param {any} strs -表示替换对应文本或值
 * @param {any} lang -表示语言
 * @param {any} debug -输出debug
 * @returns {any}
 */
language = function (dict, strs, lang, debug) {
    const result = $.ajax({
        url: dict,
        dataType: 'json',
        type: 'get',
        success: function (res) {
            for (let a = 0; a < Object.keys(strs).length; a++) {
                if (res['config'][Object.keys(strs)[a]] == "text") {
                    Object.values(strs)[a].text(Object.values(res['str'][lang][Object.keys(strs)[a]]).join(""))
                } else if (res['config'][Object.keys(strs)[a]] == "val") {
                    Object.values(strs)[a].val(Object.values(res['str'][lang][Object.keys(strs)[a]]).join(""))
                } else if (res['config'][Object.keys(strs)[a]] == "plac") {
                    Object.values(strs)[a].attr("placeholder", Object.values(res['str'][lang][Object.keys(strs)[a]]).join(""))
                }
            }
            return res;
        }
    });
    if(debug !== undefined){
        debug(result);
    }
}
const getLanguage = function (cmd) {
    /**
     * 描述
     * @date 2023-07-27
     * @param {any} cmd.dict -字典 url
     * @param {any} cmd.strs -需要替换的dom
     * @param {any} cmd.lang -语言
     * @param {any} cmd.debug -debug输出
     * @returns {any}
     */
    language(cmd.dict, cmd.strs, cmd.lang, cmd.debug);
}
// *************************************