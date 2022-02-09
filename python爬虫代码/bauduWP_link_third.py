#获取真题资料等信息
import ast
import csv
import requests
from bs4 import BeautifulSoup
import time
import random #随机数的包


def get_baiduWP_link():
    #  i_one=[11,44,71,75,80,121,202,203,205,208]百度网盘链接和提取码在wp_link_i[8].get_text() 和wp_link_i[9].get_text()
    i_one=[10,43,70,74,79,120,201,202,204,207]
    # i_two百度网盘链接和提取码在wp_link_i[10].get_text() 和wp_link_i[11].get_text()
    i_two=[2,6,8,15,16,18,25,28,35,41,47,49,63,68,71,72,75,81,84,88,
           90,92,93,94,95,98,100,101,103,106,107,109,126,165,169,173, 179,180,182,205,206]
    # 学校重复以及特殊学校不执行
    i_three = [44, 51, 62, 73, 96, 102, 105, 117, 119, 122, 127, 139, 163, 164, 171,
               181, 185, 188, 189, 194, 195, 196,197, 199, 200 ,3,9,19,27,37,52,56,85,86,89,91,111,138,178,186,187]
    #i_four=[3,9,19,27,37,52,56,85,86,89,91,111,138,178,186,187]
    for i in range(1,209):  # i=0为表头中“文章地址”,不输出209
        try:
            '''（1）r若为重复，则跳出循环，执行下一次'''
            three = True
            for i_num_three in range(0, len(i_three)):
                if i == i_three[i_num_three]:
                    print("-------------"+i+"为重复，跳出不执行")
                    three = False
            if three == False:
                continue
                '''解析网页'''
            html=requests.get(column[i],headers=headers,proxies=proxies,timeout=5) #发送请求
            soup = BeautifulSoup(html.content, "html.parser")
            rich_media_wrp = soup.find_all("div", attrs={"class": "rich_media_wrp"})  # 倒数第二层div
            rich_media_content = soup.find_all("div", attrs={"class": "rich_media_content"})  # 最近一层
        except:
            continue
            '''获取标题'''
        for j in rich_media_wrp:
            try:
                coolage = j.find("h2").get_text() #资料包名称
                print(coolage)
                #print(coolage[-48:-16])
            except:
                continue
        first=True
        second=True
        for i_num_one in range(0, len(i_one)):
            if i == i_one[i_num_one]:
                first=False
        for i_num_two in range(0, len(i_two)):
            if i == i_two[i_num_two]:
                second=False
        '''获取具体内容'''
        for z in rich_media_content:
            try:
                ''' （1） i_one=[11,44,71,75,80,121,202,203,205,208]百度网盘链接和提取码在wp_link_i[8].get_text() 和wp_link_i[9].get_text()'''
                if first == False:
                        wp_link_i = z.find_all("span")
                        wp_link_add = wp_link_i[8].get_text()  # 网盘链接
                        print("(1)------------"+wp_link_add)
                        wp_link_numb = wp_link_i[9].get_text()  # 网盘链接提取码
                        print("(1)------------"+wp_link_numb)
                #（2）i_two百度网盘链接和提取码在wp_link_i[10].get_text() 和wp_link_i[11].get_text()
                elif second==False:
                    wp_link_i = z.find_all("span")
                    wp_link_add = wp_link_i[10].get_text()  # 网盘链接
                    print("(2)-----------------------"+wp_link_add)
                    wp_link_numb = wp_link_i[11].get_text()  # 网盘链接提取码
                    print("(2)-----------------------"+wp_link_numb)
                else:
                #（3）大部分百度网盘链接和提取码在wp_link_i[9].get_text() 和wp_link_i[10].get_text()
                    wp_link_i=z.find_all("span")
                    wp_link_add = wp_link_i[9].get_text() #网盘链接
                    print("(3)++++++++++++++++++++++++++++++++++++++++++++"+wp_link_add)
                    wp_link_numb = wp_link_i[10].get_text()  # 网盘链接提取码
                    print("(3)++++++++++++++++++++++++++++++++++++++++++++"+wp_link_numb)

                merge = {"标题":coolage[-48:-16],
                         "文章链接":column[i],
                         "网盘链接":wp_link_add,
                         "提取码":wp_link_numb,
                         }
                csv_writer.writerow(merge)
            except:
                continue

'''处理特殊的几个文章链接'''
def get_baiduWP_link_two():
    #个别学校单独
    i_four = [3, 9, 19, 27, 37, 52, 56, 85, 86, 89, 91, 111, 138, 178, 186, 187]
    for i in i_four:  # i=0为表头中“文章地址”,不输出209
        try:
            ''''解析网页'''
            html = requests.get(column[i], headers=headers, proxies=proxies, timeout=5)  # 发送请求
            soup = BeautifulSoup(html.content, "html.parser")
            rich_media_wrp = soup.find_all("div", attrs={"class": "rich_media_wrp"})  # 倒数第二层div
            rich_media_content = soup.find_all("div", attrs={"class": "rich_media_content"})  # 最近一层
        except:
            continue
            '''获取标题'''
        for j in rich_media_wrp:
            try:
                college = j.find("h2").get_text()  # 资料包名称
                print(college[-48:-16])
            except:
                continue
        '''获取具体内容'''
        for z in rich_media_content:
            try:
                if i in [3,178]:#(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_add = wp_link_i[12].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[13].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i==9:#(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_add = wp_link_i[11].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[12].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i==19:  #p7+11(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_p[7].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[11].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i==27:#(正确)
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_p[0].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_p[1].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)
                elif i==37:#(正确)
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_p[6].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_p[7].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)
                elif i==52: #(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_add = wp_link_i[13].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[14].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i == 56:
                    wp_link_s = z.find_all("section")
                    wp_link_add = wp_link_s[8].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_s[9].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)
                elif i in [85,86,89]:#(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_add = wp_link_i[10].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[12].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i ==91:#(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_i[10].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_p[0].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)
                elif i==111:#(正确)
                    wp_link_i = z.find_all("span")
                    wp_link_add = 'https://pan'+wp_link_i[10].get_text()  # 网盘链接
                    print(i,"(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_i[11].get_text()  # 网盘链接提取码
                    print(i,"(4)------------" + wp_link_numb)
                elif i==138:
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_p[8].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_p[9].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)

                elif i in [186,187]:#(正确)
                    wp_link_p = z.find_all("p")
                    wp_link_add = wp_link_p[7].get_text()  # 网盘链接
                    print(i, "(4)------------" + wp_link_add)
                    wp_link_numb = wp_link_p[8].get_text()  # 网盘链接提取码
                    print(i, "(4)------------" + wp_link_numb)


                merge = {"标题":  college[-48:-16],
                         "文章链接": column[i],
                         "网盘链接": wp_link_add,
                         "提取码": wp_link_numb,
                         }
                csv_writer.writerow(merge)
            except:
                continue

if __name__ == '__main__':
    start = time.time()  # 开始时间
    """"
        模拟浏览器访问
        """
    # 2用户代理和ip代理
    # 2.1创建代理ip的序列
    file = open("代理IP地址300.txt", "r", 1);
    # 字符串转换为数组形式
    list_proxies = ast.literal_eval(file.read());
    # 2.2.模拟浏览器：
    list_headers = []
    list_headers.append({
                            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/18.17763"})
    list_headers.append({
                            "User-agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.17 Safari/537.36"})
    list_headers.append({"User-agent": "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko"})
    # 3.开始网络访问
    # 随机数随机选择任意一个
    an_num = random.randint(0, 290);
    proxies = list_proxies[an_num];
    num2 = random.randint(0, len(list_headers) - 1)
    headers = list_headers[num2]
    with open("csv_document/灰灰考研公众号.csv",'r',encoding='utf-8') as f:
        reader=csv.reader(f)
        column=[row[1] for row in reader] #提取csv文件中各学校资料包的链接，存入column数组
    '''写入表头'''
    f = open("csv_document/网盘链接——提取码.csv", mode='a', encoding='utf-8', newline='')
    csv_writer = csv.DictWriter(f, fieldnames=['标题','文章链接', '网盘链接', '提取码',])
    csv_writer.writeheader()

    '''调用函数'''
    get_baiduWP_link()
    get_baiduWP_link_two()
    end = time.time()




