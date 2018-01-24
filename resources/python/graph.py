import pandas as pd
import sys, getopt
import json


def main(argv):
   directory = ''
   data = ''
   method = ''
   experiment = ''

   try:
      opts, args = getopt.getopt(argv,"hd:c:m:e:")
   except getopt.GetoptError:
      print 'graph.py -d <directory> -c <csv> -m <method> -e=<experiment>'
      sys.exit(2)
   for opt, arg in opts:
      if opt == '-h':
         print 'test.py -directory <directory> -data <v> -segment <name> -exeriment=<experiment>'
         sys.exit()
      elif opt == "-d":
         directory = arg
      elif opt == "-c":
         data = arg
      elif opt == "-m":
         method = arg
      elif opt == "-e":
         experiment = arg

   patterns = get_patterns(directory+"/"+experiment+".json")
   df = pd.read_csv(directory+"/"+data+".csv")


   if method == 'visits':
      print visits(df, patterns)



def visits(df, patterns):
    return pagesByTimePeriod(df, patterns)


def pagesByTimePeriod(df, patterns):

    df2 = pd.DataFrame();

    num = 0;
    for i in patterns:
        print i
        pages_df = df[
            df['enter page'].str.contains(i)
        ].sort_values(by = 'week', ascending=False).groupby('week')[['visit num']].sum()

        if num == 0:
            df2 = pages_df
        else:
            df2 = pd.merge(df2, pages_df, left_index=True, right_index=True)

        num = num + 1

    return df2





def get_patterns(jsonfile):
   with open(jsonfile) as json_file:
       data = json.load(json_file)
   return data;




if __name__ == "__main__":
   main(sys.argv[1:])