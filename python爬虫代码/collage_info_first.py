#用于爬取地区、省份和院校信息
import ast
import os
import urllib
import random
import requests
from lxml import etree
import csv
import time

class CollegeMessage(): #定义大学信息类
        def __init__(self):  #类方法必须包含参数 self, 且为第一个参数，self 代表的是类的实例
            # 模拟浏览器：
            list_headers = []
            list_headers.append({"cookie": "zg_did=%7B%22did%22%3A%20%221768f22ba38570-0b610629bd4035-5a301e44-e1000-1768f22ba39671%22%7D; _ga=GA1.3.975177554.1608719187; zg_14e129856fe4458eb91a735923550aa6=%7B%22sid%22%3A%201617094307897%2C%22updated%22%3A%201617094368734%2C%22info%22%3A%201617094307900%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22cn.bing.com%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fwww.chsi.com.cn%2F%22%7D; zg_0d76434d9bb94abfaa16e1d5a3d82b52=%7B%22sid%22%3A%201617094379483%2C%22updated%22%3A%201617094480389%2C%22info%22%3A%201617094379486%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22www.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Faccount.chsi.com.cn%2Fpassport%2Flogin%3Fservice%3Dhttps%253A%252F%252Fmy.chsi.com.cn%252Farchive%252Fj_spring_cas_security_check%253Bjsessionid%253D4D6A8AFEAB9EF4DF16C61DB6611B21E3%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D; zg_90dc219b89ee40d99689b0ed4befbe51=%7B%22sid%22%3A%201617094700329%2C%22updated%22%3A%201617094705431%2C%22info%22%3A%201617094700332%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22vote.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fxz.chsi.com.cn%2Fsurvey%2Findex.action%22%7D; _gid=GA1.3.1355318729.1617511423; CHSICC_CLIENTFLAGYZ=c49e3a95250291db4149eabf1d7f6930; zg_adfb574f9c54457db21741353c3b0aa7=%7B%22sid%22%3A%201617517940971%2C%22updated%22%3A%201617518778606%2C%22info%22%3A%201617094521965%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22yz.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fyz.chsi.com.cn%2F%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D",
                "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/18.17763"})
            list_headers.append({"cookie": "zg_did=%7B%22did%22%3A%20%221768f22ba38570-0b610629bd4035-5a301e44-e1000-1768f22ba39671%22%7D; _ga=GA1.3.975177554.1608719187; zg_14e129856fe4458eb91a735923550aa6=%7B%22sid%22%3A%201617094307897%2C%22updated%22%3A%201617094368734%2C%22info%22%3A%201617094307900%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22cn.bing.com%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fwww.chsi.com.cn%2F%22%7D; zg_0d76434d9bb94abfaa16e1d5a3d82b52=%7B%22sid%22%3A%201617094379483%2C%22updated%22%3A%201617094480389%2C%22info%22%3A%201617094379486%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22www.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Faccount.chsi.com.cn%2Fpassport%2Flogin%3Fservice%3Dhttps%253A%252F%252Fmy.chsi.com.cn%252Farchive%252Fj_spring_cas_security_check%253Bjsessionid%253D4D6A8AFEAB9EF4DF16C61DB6611B21E3%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D; zg_90dc219b89ee40d99689b0ed4befbe51=%7B%22sid%22%3A%201617094700329%2C%22updated%22%3A%201617094705431%2C%22info%22%3A%201617094700332%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22vote.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fxz.chsi.com.cn%2Fsurvey%2Findex.action%22%7D; _gid=GA1.3.1355318729.1617511423; CHSICC_CLIENTFLAGYZ=c49e3a95250291db4149eabf1d7f6930; zg_adfb574f9c54457db21741353c3b0aa7=%7B%22sid%22%3A%201617517940971%2C%22updated%22%3A%201617518778606%2C%22info%22%3A%201617094521965%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22yz.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fyz.chsi.com.cn%2F%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D",
                "User-agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.17 Safari/537.36"})
            list_headers.append({"cookie": "zg_did=%7B%22did%22%3A%20%221768f22ba38570-0b610629bd4035-5a301e44-e1000-1768f22ba39671%22%7D; _ga=GA1.3.975177554.1608719187; zg_14e129856fe4458eb91a735923550aa6=%7B%22sid%22%3A%201617094307897%2C%22updated%22%3A%201617094368734%2C%22info%22%3A%201617094307900%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22cn.bing.com%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fwww.chsi.com.cn%2F%22%7D; zg_0d76434d9bb94abfaa16e1d5a3d82b52=%7B%22sid%22%3A%201617094379483%2C%22updated%22%3A%201617094480389%2C%22info%22%3A%201617094379486%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22www.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Faccount.chsi.com.cn%2Fpassport%2Flogin%3Fservice%3Dhttps%253A%252F%252Fmy.chsi.com.cn%252Farchive%252Fj_spring_cas_security_check%253Bjsessionid%253D4D6A8AFEAB9EF4DF16C61DB6611B21E3%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D; zg_90dc219b89ee40d99689b0ed4befbe51=%7B%22sid%22%3A%201617094700329%2C%22updated%22%3A%201617094705431%2C%22info%22%3A%201617094700332%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22vote.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fxz.chsi.com.cn%2Fsurvey%2Findex.action%22%7D; _gid=GA1.3.1355318729.1617511423; CHSICC_CLIENTFLAGYZ=c49e3a95250291db4149eabf1d7f6930; zg_adfb574f9c54457db21741353c3b0aa7=%7B%22sid%22%3A%201617517940971%2C%22updated%22%3A%201617518778606%2C%22info%22%3A%201617094521965%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22yz.chsi.com.cn%22%2C%22landHref%22%3A%20%22https%3A%2F%2Fyz.chsi.com.cn%2F%22%2C%22cuid%22%3A%20%22b607716f21526c7e367772f4efcc61ca%22%7D",
                "User-agent": "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko"})
            #随机数随机选择任意一个
            num2 = random.randint(0, len(list_headers) - 1)
            self.headers = list_headers[num2]
            '''(1)获取所有的省份和代码'''
        def get_all_province(self):
            url = "https://yz.chsi.com.cn/sch/?start=0"  # 目标网站
            try: #异常处理
                response = requests.get(url, headers=self.headers,proxies=proxies,timeout=3)  # 为请求添加头部信息
            except urllib.HTTPError as err:
                print(err)
            res = response.content.decode()  # 获取网页信息
            html_str = etree.HTML(res)  # 用lxml方式来解析字符串格式的HTML文档对象
            all_span = html_str.xpath(
                "//div[@class='container']/div[@class='yxk-filter']/form/ul/li/div[@class='list-td clearfix']/span")
            all_span = all_span[1:-4]  # 去掉不需要的信息
            for span in all_span:
                try:
                    collage_name = span.xpath("text()")[0]  # 省份名字
                    collage_code = span.xpath("@data-id")[0]  # 省份数字代码
                    dict_collage[collage_name] = collage_code  # 将名字和代码装入字典中
                except:
                    continue


            '''(2)省份中所有的招研究生大学名字 collage_value为省份代码'''
        def province_collage(self, collage_value):
            url = "https://yz.chsi.com.cn/sch/search.do?ssdm={}&yxls=".format(collage_value)  # 接收该省市数字代码为地址
            try:
                response = requests.get(url, headers=self.headers,proxies=proxies,timeout=3)
            except urllib.HTTPError as err:
                print(err)
            res = response.content.decode()
            html_str = etree.HTML(res)
            collages_name = html_str.xpath("//div[@class='yxk-table']/div/div/form/ul/li/a")  # 通过xpath语法锁定数据位置
            number_max_collage = 0   #省份中含有的大学数量最大值
            for collage_i in collages_name:
                if collage_i.xpath("text()"):  # 如果一个列表不为空的话(考虑到可能会有空的数据)
                    collage_i_number = int(collage_i.xpath("text()")[0])
                    if collage_i_number > number_max_collage:
                        number_max_collage = collage_i_number
            for i_page in range(number_max_collage):
                try:
                    i_page_url = str(i_page * 20)  # 每页的start值相差20
                    # 调用函数---获取大学名称
                    self.get_collage(collage_value, i_page_url)
                except:
                    continue

            '''(3)获取省份内每所大学名称'''
        def get_collage(self, collage_value_url, i_page_url):  # 执行每一页的数据获取
            url = "https://yz.chsi.com.cn/sch/search.do?ssdm={}&start={}".format(collage_value_url, i_page_url)
            try:
                response = requests.get(url, headers=self.headers,proxies=proxies,timeout=3)
            except urllib.HTTPError as err:
                print(err)
            res = response.content.decode()
            html_str = etree.HTML(res)
            tr_collages = html_str.xpath("//div[@class='yxk-table']/table/tbody/tr")
            collage_name_array = []  # 定义一个空列表，用来存放某省份的所有大学
            for i_tr in tr_collages:  # 输出该省市所有的大学名字
                try:
                    collage_name = i_tr.xpath("td[1]/a/text()")[0].strip()
                    # print(collage_name) # 输出一个大学名字
                    collage_name_array.append(collage_name)  # 将大学名字添加到数组中
                    # 调用函数，获取每所学校具体的信息，collage_name_array为某省份内的所有研究生大学
                except:
                    continue
            self.get_collage_message(collage_value_url, collage_name_array)

            '''(4)通过学科门类和专业类别去筛选学校'''
        def get_collage_message(self, province_value, collage_name_array):  # 接收一个省份的数字代码province_value=collage_value_url
            XueKML = {
                "专业学位": 0, "理学": 7, "工学": 8
            }
            ZhuanYLY = [
                ["(0854)电子信息"],
                ["(0775)计算机科学与技术"],
                ["(0812)计算机科学与技术", "(0835)软件工程", "(0839)网络空间安全"],
            ]
            for collage_i in collage_name_array:
                try:
                    university_url = collage_i  # 某所学校
                    for xueke_i in XueKML.keys():  # 遍历学科门类
                        xue_key = xueke_i
                        menlei_url = self.get_xuekeleibie_number(XueKML[xue_key])  # 调用获取学科类别的函数
                        if xue_key == "专业学位":
                            xuekelb_url = "0854"
                            csv_name = university_url + "_" + xue_key + "_" + xuekelb_url  # csv文件内名字
                            self.get_url(csv_name, province_value, university_url, menlei_url, xuekelb_url)
                        else:
                            for i in ["0775", "0812", "0835", "0839"]:
                                xuekelb_url = i
                                csv_name = university_url + "_" + xue_key + "_" + xuekelb_url  # csv文件内名字
                                self.get_url(csv_name, province_value, university_url, menlei_url, xuekelb_url)
                except:
                    continue
            '''获取学科类别编号'''
        def get_xuekeleibie_number(self, number):  # 获取学科类别
            if number == 0:
                return "zyxw"  # 专业学位
            elif number < 10:
                return "0" + str(number)
            else:
                return str(number)

            '''（5）获取学校具体考试信息，并写入csv文件'''
        def get_url(self,csv_name,province_value,universe_url,menlei_url,xuekelb_url):
            url = "https://yz.chsi.com.cn/zsml/querySchAction.do?ssdm={}&dwmc={}&mldm={}&yjxkdm={}&xxfs=&zymc="
            # https://yz.chsi.com.cn/zsml/querySchAction.do?ssdm=22&dwmc=长春大学&mldm=02&yjxkdm=0202&xxfs=&zymc=
            try:
                response = requests.get(url.format(province_value,universe_url,menlei_url,xuekelb_url),headers=self.headers,proxies=proxies,timeout=3)
            except urllib.HTTPError as err:
                print(err)
            res = response.content.decode()
            html_str = etree.HTML(res)

            tr_message = html_str.xpath("//table[@class='ch-table more-content']/tbody/tr")
            if tr_message:
                page_message = []
                for one_tr in tr_message:
                    try:
                        YuanXiSuo = one_tr[1].xpath("text()")[0] # 获取院系所信息
                        ZhuanYe = one_tr[2].xpath("text()")[0] # 获取专业信息
                        YanJiuFangXiang = one_tr[3].xpath("text()")[0] # 获取研究方向信息
                        number_strs = one_tr[7].xpath("a/@href")[0] # 获取具体信息链接

                        exam_subject = self.peoples_exam_data(number_strs) # 返回两个字符串

                        one_message = {"省份":list(dict_collage.keys())[list(dict_collage.values()).index(province_value)],#省份
                                "学校":universe_url,  #学校
                                "院系":YuanXiSuo,  # Department
                                "专业":ZhuanYe,   # SpecialField
                                "研究方向":YanJiuFangXiang,   # ResearchFields
                                "考试学科":exam_subject
                            }
                        page_message.append(one_message)
                        """
                                        将字典数据写入csv表格中
                                        （1）头部信息header要和字典中的key值相对应
                                        （2）文件名字采用csv_name
                                        （3）以追加“a”的方式写入
                                        （4）newline是数据之间不加空行
                                        （5）encoding='utf-8'表示编码格式为utf-8，如果不希望在excel中打开csv文件出现中文乱码的话，将其去掉不写也行。
                                    """
                    except:
                        continue
                for one_i in page_message:
                    print(one_i)

                header=["省份","学校", "院系", "专业", "研究方向", "考试学科"]
                with open('csv_document/计算机研招院校.csv','a',newline='',encoding='utf-8') as f:
                    writer = csv.DictWriter(f,fieldnames=header)# 提前预览列名，当下面代码写入数据时，会将其一一对应。
                    #writer.writeheader()# 写入列名
                    writer.writerows(page_message)# 写入数据
            else:
                print(universe_url+"----无信息----")

            '''（6）获取考试范围'''
        def peoples_exam_data(self,end_url):    # 获取该专业的考试范围信息
            url = "https://yz.chsi.com.cn"+end_url
            try:
                response = requests.get(url,headers=self.headers,proxies=proxies,timeout=3)
            except urllib.HTTPError as err:
                print(err)
            res = response.content.decode()
            html_str = etree.HTML(res)

            exam_subjects = html_str.xpath("//div[@class='zsml-result']/table/tbody/tr/td") # 提取考试范围信息
            examSubject = ""  #定义为字符串
            count_i =1
            for one_exam in exam_subjects:
                try:
                    if count_i % 5 ==0: # 假如出现多项选择的话：
                        examSubject = examSubject + "或者:"
                    else:
                        examSubject = examSubject + one_exam.xpath("text()")[0].strip() + ","
                    count_i += 1
                    examSubject =examSubject[7:-1] # 去掉最后一个逗号
                except:
                    continue
            return examSubject

        '''（7）调用函数'''
        def run(self):
            if os.path.exists("csv_document"):
                pass
            else:
                os.mkdir("csv_document")
                pass
            self.get_all_province()  # 获取省份的值
            time.sleep(2)
            '''避免重复写入表头，所以在获取院校信息之前先写入表头'''
            header = ["省份","学校", "院系", "专业", "研究方向", "考试学科"]
            with open('csv_document/计算机研招院校.csv', 'a', newline='', encoding='utf-8') as f:
                writer = csv.DictWriter(f, fieldnames=header)  # 提前预览列名，当下面代码写入数据时，会将其一一对应。
                writer.writeheader()# 写入列名
            for i in dict_collage.values():
                self.province_collage(i) # 获取此省份所有招研究生的学校
                print("--------------------------"+list(dict_collage.keys())[list(dict_collage.values()).index(i)]+"省检索完------------------------------------")
                time.sleep(2) #获取一个省份所有学校的计算机专业考研考试范围后休眠2秒，然后进行下一个省份的爬取

if __name__ == '__main__':
    start = time.time()  # 开始时间
    # 1用户代理和ip代理
    # 1.1创建代理ip的序列
    file = open("代理IP地址300.txt", "r", 1);
    # 字符串转换为数组形式
    list_proxies = ast.literal_eval(file.read());

    # 2.开始网络访问
    # 随机数随机选择任意一个
    an_num = random.randint(0, 290);
    proxies = list_proxies[an_num];

    #3实例化类，调用类的函数
    dict_collage = {}  # 定义空字典,用来存放省份和省份编号
    cm = CollegeMessage()
    cm.run()
    end = time.time()
    print("总共用时{}秒".format((end - start)))
