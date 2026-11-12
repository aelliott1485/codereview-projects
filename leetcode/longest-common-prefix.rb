# @param {String[]} strs
# @return {String}
#
# Leetcode Runtime: 6ms - beats 39.85%
# Leetcode Memory: 13.34 MB beats 100%
def longest_common_prefix(strs)
    prefix = ""
	first_str = strs.shift
	first_str.each_char.with_index do |char, idx|
	  break if false == strs.all? { |str| str[idx] == char }
	  prefix = "#{prefix}#{char}"
	end
	prefix
end
puts longest_common_prefix(["flower","flow","flight"])
puts longest_common_prefix(["flower","flow"])
puts longest_common_prefix(["dog","racecar","car"])