def	htmlify(el, indent):
	html = "\t" * indent + "<td>\n"
	html += "\t" * (indent + 1) + "<p class=\"weight\">" + el[3].rstrip() + "</p>\n"
	html += "\t" * (indent + 1) + "<p class=\"sym\">" + el[1] + "</p>\n"
	html += "\t" * (indent + 1) + "<p class=\"num\">" + el[2] + "</p>\n"
	html += "\t" * indent +  "</td>\n"
	return html

def cmpcmp(e1, e2):
	if int(e1.split(' ')[2]) > int(e2.split(' ')[2]):
		return 1
	else:
		return -1


with open('data.txt', 'r') as file:
	data = file.readlines()

html = ""
data.sort(cmpcmp)

for i in range(len(data)):
	data[i] = data[i].split(' ')
	html += htmlify(data[i], 5)

print(html)
